<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 12:20 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Routing;


class SimpleDispatcherResult implements DispatcherResult {
    private $status;
    private $handler;
    private $arguments;

    /**
     * gets dispatching result status
     * @return int
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * gets dispatched handler
     * @return mixed
     */
    public function getHandler() {
        return $this->handler;
    }

    /**
     * Gets assoc array of arguments
     * @return array
     */
    public function getArguments() {
        return $this->arguments;
    }

    /**
     * @param $status
     * @param $handler
     * @param array $arguments
     * @throws \InvalidArgumentException
     */
    public function __construct($status, $handler, array $arguments) {
        if (!is_int($status)) {
            throw new \InvalidArgumentException('SimpleDispatcherResult::__construct expects parameter 1 to be int.'.gettype($status).' given.');
        }

        $this->status = $status;
        $this->handler = $handler;
        $this->arguments = $arguments;
    }
}