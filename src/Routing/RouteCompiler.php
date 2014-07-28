<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 11:25 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Routing;


interface RouteCompiler {
    /**
     * @param $route string
     * @param $handler mixed
     * @return Route
     * @throws \InvalidArgumentException
     */
    public function compile($route, $handler);
}