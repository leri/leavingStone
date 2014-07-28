<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 2:21 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Http;


interface Response {
    /**
     * gets status code
     * @return int
     */
    public function getStatusCode();

    /**
     * sets status code
     * @param $status int
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setStatusCode($status);

    /**
     * gets headers
     * @return array
     */
    public function getHeaders();

    /**
     * adds header.
     * @param $key string
     * @param $value string
     * @return void
     * @throws \InvalidArgumentException
     */
    public function addHeader($key, $value);

    /**
     * gets content body
     * @return string
     */
    public function getBody();

    /**
     * @param $body string
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setBody($body);
}