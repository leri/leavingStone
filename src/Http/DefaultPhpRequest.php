<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 2:37 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Http;


class DefaultPhpRequest implements Request {
    private $uri;
    private $uriPath;
    private $httpMethod;
    private $headers;
    private $query;
    private $post;
    private $files;
    private $cookies;
    private $serverVariables;

    public function __construct(array $server, array $get, array $post, array $files, array $cookies) {
        $this->processServerVariables($server);

        $this->query = $get;
        $this->post = $post;
        $this->files = $files;
        $this->cookies = $cookies;
    }

    /**
     * gets requested uri
     * @return string
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * gets requested uri pass
     * @return string
     */
    public function getUriPath() {
        return $this->uriPath;
    }

    public function getHttpMethod() {
        return $this->httpMethod;
    }

    /**
     * gets all query string parameters ($_GET)
     * @return array
     */
    public function getQuery() {
        return $this->query;
    }

    /**
     * gets variable in query string
     * @param $name string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getQueryVariable($name) {
        $this->validateVariableNameType($name, 'DefaultPhpRequest::getQueryVariable');

        return isset($this->query[$name]) ? $this->query[$name] : null;
    }

    /**
     * gets all posted variables.
     * @return array
     */
    public function getPost() {
        return $this->post;
    }

    /**
     * gets posted variable by name
     * @param $name string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getPostVariable($name) {
        $this->validateVariableNameType($name, 'DefaultPhpRequest::getPostVariable');

        return isset($this->post[$name]) ? $this->post[$name] : null;
    }

    /**
     * gets all file variables
     * @return array
     */
    public function getFiles() {
        return $this->files;
    }

    /**
     * gets file variable by name
     * @param $name string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getFileVariable($name) {
        $this->validateVariableNameType($name, 'DefaultPhpRequest::getFileVariable');

        return isset($this->files[$name]) ? $this->files[$name] : null;
    }

    /**
     * gets all request headers
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * gets header variable by name
     * @param $name string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getHeaderVariable($name) {
        $this->validateVariableNameType($name, 'DefaultPhpRequest::getHeaderVariable');

        $name = strtoupper($name);

        return isset($this->query[$name]) ? $this->query[$name] : null;
    }

    /**
     * gets all cookies
     * @return array
     */
    public function getCookies() {
        return $this->cookies;
    }

    /**
     * gets cookie variable by name
     * @param $name string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getCookieVariable($name) {
        $this->validateVariableNameType($name, 'DefaultPhpRequest::getCookieVariable');

        return isset($this->cookies[$name]) ? $this->cookies[$name] : null;
    }

    /**
     * gets all -server variables
     * @return array
     */
    public function getServerVariables() {
        return $this->serverVariables;
    }

    /**
     * gets server variable by name
     * @param $name string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getServerVariable($name) {
        $this->validateVariableNameType($name, 'DefaultPhpRequest::getServerVariable');

        return isset($this->serverVariables[$name]) ? $this->serverVariables[$name] : null;
    }

    private function processServerVariables(array $server) {
        foreach ($server as $key => $val) {
            if (strpos($key, 'HTTP_') === 0) {
                $key = substr($key, 5);
                $this->headers[$key] = $val;
            }
        }

        $this->uri = $server['REQUEST_URI'];
        $this->uriPath = parse_url($this->uri, PHP_URL_PATH);
        $this->httpMethod = $server['REQUEST_METHOD'];

        $this->serverVariables = $server;
    }

    private function validateVariableNameType($name, $context) {
        if (!is_string($name)) {
            throw new \InvalidArgumentException($context.' expects parameter 1 to be string. '.gettype($name).' given.');
        }
    }
}