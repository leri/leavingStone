<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 12:16 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Routing;


class RegexDispatcher implements Dispatcher {
    private $routeCollection;

    /**
     * @param $httpMethod string
     * @param $uri string
     * @return SimpleDispatcherResult
     * @throws \InvalidArgumentException
     */
    public function dispatch($httpMethod, $uri) {
        if (!is_string($httpMethod)) {
            throw new \InvalidArgumentException('RegexDispatcher::dispatch expects parameter 1 to be string. '.gettype($httpMethod).' given.');
        }

        if (!is_string($uri)) {
            throw new \InvalidArgumentException('RegexDispatcher::dispatch expects parameter 2 to be string. '.gettype($uri).' given.');
        }

        if ($uri !== '/') {
            $uri = rtrim($uri, '/');
        }

        $routes = $this->routeCollection->getRoutes($httpMethod);

        /** @var $route Route */
        foreach ($routes as $route) {
            if ($route->match($uri)) {
                $handler = $route->getHandler();
                $arguments = $route->getArguments();

                return new SimpleDispatcherResult(Dispatcher::OK, $handler, $arguments);
            }
        }

        return new SimpleDispatcherResult(Dispatcher::NOT_FOUND, null, array());
    }

    public function __construct(RouteCollection $routeCollection) {
        $this->routeCollection = $routeCollection;
    }
}