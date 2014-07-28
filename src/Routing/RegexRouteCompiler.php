<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 11:54 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Routing;


class RegexRouteCompiler implements RouteCompiler {
    const TRANSLATION_PATTERN = '/\{(\w+):(.+?)\}/';
    const TRANSLATION_FORMAT = '(?P<$1>$2)';

    /**
     * @param $route string
     * @param $handler mixed
     * @return Route
     * @throws \InvalidArgumentException
     */
    public function compile($route, $handler) {
        if (!is_string($route)) {
           throw new \InvalidArgumentException('RegexRouteCompiler::compile expects parameter 1 to be string. '.gettype($route).' given.');
        }

        $pattern = preg_replace(static::TRANSLATION_PATTERN, static::TRANSLATION_FORMAT, $route);
        $route = new RegexRoute('#^'.$pattern.'$#', $handler);

        return $route;
    }
}