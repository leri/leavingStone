<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 11:48 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application;


use Twitter\DependencyInjection\Injector;
use Twitter\DependencyInjection\InjectorBuilder;
use Twitter\Http\Request;
use Twitter\Http\Response;
use Twitter\Routing\Dispatcher;
use Twitter\Routing\DispatcherBuilder;

class App {
    const PHP_NAME_PATTERN = '#^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$#';

    private $request;
    private $dispatcherBuilder;
    private $injectorBuilder;
    private $notFoundHandler;
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * @var Injector
     */
    private $injector;

    public function buildDispatcher(callable $routeCollector) {
        $this->dispatcher = $this->dispatcherBuilder->build($routeCollector);
    }

    public function buildInjector(callable $dependencyCollector) {
        $this->injector = $this->injectorBuilder->build($dependencyCollector);
    }

    public function setNotFoundHandler(array $handler) {
        $this->notFoundHandler = $handler;
    }

    public function run($ignorePath = null) {
        $uriPath = $this->request->getUriPath();
        $httpMethod = $this->request->getHttpMethod();

        if ($ignorePath !== null && strpos($uriPath, $ignorePath) === 0) {
            $uriPath = substr($uriPath, strlen($ignorePath));
        }

        $dispatcherResult = $this->dispatcher->dispatch($httpMethod, $uriPath);
        $status = $dispatcherResult->getStatus();

        switch ($status) {
            case Dispatcher::OK:
                $handler = $dispatcherResult->getHandler();
                $arguments = $dispatcherResult->getArguments();
                $this->runHandler($handler, $arguments);
                break;
            case Dispatcher::NOT_FOUND:
                $this->onNotFound();
                break;
        }
    }

    public function __construct(Request $request, DispatcherBuilder $dispatcherBuilder, InjectorBuilder $injectorBuilder) {
        $this->dispatcherBuilder = $dispatcherBuilder;
        $this->injectorBuilder = $injectorBuilder;
        $this->request = $request;
    }

    private function onNotFound() {
        if ($this->notFoundHandler === null ||
            !isset($this->notFoundHandler['controller']) ||
            !is_string($this->notFoundHandler['controller']) ||
            !isset($this->notFoundHandler['action']) ||
            !is_string($this->notFoundHandler['action'])) {
            throw new \LogicException('Invalid not found handler');
        }

        $this->runController($this->notFoundHandler['controller'], $this->notFoundHandler['action'], array());
    }

    /**
     * @param $handler
     * @param array $arguments
     * @throws \LogicException
     */
    private function runHandler($handler, array $arguments) {
        $arguments += $this->request->getQuery();

        if (!is_string($handler)) {
            throw new \LogicException('Handler should be a string.');
        }

        if (strpos($handler, '::') === false) {
            throw new \LogicException('Handler is missing class and method separator');
        }

        list($controllerType, $methodName) = explode('::', $handler);

        if (empty($controllerType)) {
            throw new \LogicException('controller is not defined.');
        }

        if (empty($methodName)) {
            throw new \LogicException('action is not defined');
        }

        if (!(bool)preg_match(static::PHP_NAME_PATTERN, $methodName)) {
            throw new \LogicException('methodName is not valid method name for php');
        }

        $controllerParts = explode('\\', $controllerType);

        foreach ($controllerParts as $controllerPart) {
            if (empty($controllerPart))
                continue;

            if (!(bool)preg_match(static::PHP_NAME_PATTERN, $controllerPart)) {
                throw new \LogicException('controller has invalid characters, i.e. is not valid class name');
            }
        }

        $this->runController($controllerType, $methodName, $arguments);
    }

    private function runController($controllerType, $methodName, array $arguments) {
        $controller = $this->injector->resolveUnregistered($controllerType);
        $response = $this->injector->resolveMethodAndCall($controller, $methodName, $arguments);

        $this->output($response);
    }

    private function output(Response $response) {
        $status = $response->getStatusCode();
        http_response_code($status);

        $headers = $response->getHeaders();

        foreach ($headers as $key => $val) {
            header($key.':'.$val);
        }

        $body = $response->getBody();

        echo $body;
    }
}