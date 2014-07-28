<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 12:27 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Routing;


class RegexDispatcherBuilder implements DispatcherBuilder {

    /**
     * @param callable $routeCollector
     * @return Dispatcher
     */
    public function build(callable $routeCollector) {
        $routeCompiler = new RegexRouteCompiler();
        $routeCollection = new SimpleRouteCollection($routeCompiler);

        $routeCollector($routeCollection);

        return new RegexDispatcher($routeCollection);
    }
}