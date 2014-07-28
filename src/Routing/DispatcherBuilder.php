<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 11:28 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Routing;


interface DispatcherBuilder {
    /**
     * @param callable $routeCollector
     * @return Dispatcher
     */
    public function build(callable $routeCollector);
}