<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 12:18 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Routing;


interface DispatcherResult {
    /**
     * gets dispatching result status
     * @return int
     */
    public function getStatus();

    /**
     * gets dispatched handler
     * @return mixed
     */
    public function getHandler();

    /**
     * Gets assoc array of arguments
     * @return array
     */
    public function getArguments();
}