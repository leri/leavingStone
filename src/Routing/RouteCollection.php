<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 11:02 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Routing;


interface RouteCollection {
    /**
     * @param $httpMethod string
     * @param $route string
     * @param $handler mixed
     * @return void
     * @throws \InvalidArgumentException
     */
    public function addRoute($httpMethod, $route, $handler);

    /**
     * Gets associated routes for http method
     * @param $httpMethod
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getRoutes($httpMethod);
}