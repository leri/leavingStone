<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 4:00 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Http;


interface Session {
    /**
     * @param $name string
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getVariable($name);

    /**
     * @param $name string
     * @param $value string
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setVariable($name, $value);

    /**
     * @param $name string
     * @return void
     */
    public function removeVariable($name);
}