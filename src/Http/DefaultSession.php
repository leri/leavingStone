<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 4:02 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Http;


class DefaultSession implements Session {
    /**
     * @param $name string
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getVariable($name) {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('DefaultSession::getVariable expects parameter 1 to be string. '.gettype($name).' given.');
        }

        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    /**
     * @param $name string
     * @param $value string
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setVariable($name, $value) {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('DefaultSession::setVariable expects parameter 1 to be string. '.gettype($name).' given.');
        }

        $_SESSION[$name] = $value;
    }

    /**
     * @param $name string
     * @throws \InvalidArgumentException
     * @return void
     */
    public function removeVariable($name) {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('DefaultSession::removeVariable expects parameter 1 to be string. '.gettype($name).' given.');
        }

        $this->setVariable($name, null);
    }
}