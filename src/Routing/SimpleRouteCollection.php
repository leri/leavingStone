<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 11:30 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Routing;


class SimpleRouteCollection implements RouteCollection {
    private $routes = array(
        'GET' => array(),
        'POST' => array() // other methods won't be needed for demo app. Not wasting time.
    );
    private $routeCompiler;

    /**
     * @param $httpMethod string
     * @param $route string
     * @param $handler mixed
     * @return void
     * @throws \InvalidArgumentException
     */
    public function addRoute($httpMethod, $route, $handler) {
        if (!is_string($httpMethod)) {
            throw new \InvalidArgumentException('SimpleRouteCollection::addRoute expects parameter 1 to be string. '.gettype($httpMethod).' given.');
        }

        if (!is_string($route)) {
            throw new \InvalidArgumentException('SimpleRouteCollection::addRoute expects parameter 2 to be string. '.gettype($route).' given.');
        }

        if (!isset($this->routes[$httpMethod])) {
            throw new \InvalidArgumentException($httpMethod.' is undefined.');
        }

        $route = $this->routeCompiler->compile($route, $handler);
        $this->routes[$httpMethod][] = $route;
    }

    /**
     * Gets associated routes for http method
     * @param $httpMethod
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getRoutes($httpMethod) {
        if (!is_string($httpMethod)) {
            throw new \InvalidArgumentException('SimpleRouteCollection::getRoutes expects parameter 1 to be string. '.gettype($httpMethod).' given.');
        }

        if (!isset($this->routes[$httpMethod])) {
            throw new \InvalidArgumentException($httpMethod.' is undefined.');
        }

        return $this->routes[$httpMethod];
    }

    public function __construct(RouteCompiler $routeCompiler) {
        $this->routeCompiler = $routeCompiler;
    }
}