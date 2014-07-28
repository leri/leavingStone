<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 2:29 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Http;


class DefaultResponse implements Response {
    private $statusCode = 200;
    private $headers = array();
    private $body;

    /**
     * gets status code
     * @return int
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * sets status code
     * @param $status int
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setStatusCode($status) {
        if (!is_int($status)) {
            throw new \InvalidArgumentException('DefaultResponse::setStatusCode expects parameter 1 to be int. '.gettype($status).' given.');
        }

        $this->statusCode = $status;
    }

    /**
     * gets headers
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * adds header.
     * @param $key string
     * @param $value string
     * @return void
     * @throws \InvalidArgumentException
     */
    public function addHeader($key, $value) {
        if (!is_string($key)) {
            throw new \InvalidArgumentException('DefaultResponse::addHeader expects parameter 2 to be string. '.gettype($key).' given.');
        }

        if (!is_string($value)) {
            throw new \InvalidArgumentException('DefaultResponse::addHeader expects parameter 2 to be string. '.gettype($value).' given.');
        }

        $this->headers[$key] = $value;
    }

    /**
     * gets content body
     * @return string
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * @param $body string
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setBody($body) {
        if (!is_string($body)) {
            throw new \InvalidArgumentException('DefaultResponse::setBody expects parameter 2 to be string. '.gettype($body).' given.');
        }

        $this->body = $body;
    }
}