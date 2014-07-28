<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 2:10 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Routing;


interface Dispatcher {
    const NOT_FOUND = 404; // interface constants are not really that useless.
    const OK = 200;

    /**
     * @param $httpMethod string
     * @param $uri string
     * @return SimpleDispatcherResult
     * @throws \InvalidArgumentException
     */
    public function dispatch($httpMethod, $uri);
}