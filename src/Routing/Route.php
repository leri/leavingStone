<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 11:20 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Routing;


interface Route {
    /**
     * returns matched route handler
     * @return mixed
     */
    public function getHandler();

    /**
     * gets associated array of uri arguments
     * @return array
     */
    public function getArguments();

    /**
     * determines if url matches route.
     * @param $uri string
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function match($uri);
}