<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 2:37 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Http;

interface Request {
    /**
     * gets requested uri
     * @return string
     */
    public function getUri();

    /**
     * gets requested uri pass
     * @return string
     */
    public function getUriPath();

    /**
     * gets http method
     * @return string
     */
    public function getHttpMethod();

    /**
     * gets all query string parameters ($_GET)
     * @return array
     */
    public function getQuery();

    /**
     * gets variable in query string
     * @param $name string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getQueryVariable($name);

    /**
     * gets all posted variables.
     * @return array
     */
    public function getPost();

    /**
     * gets posted variable by name
     * @param $name string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getPostVariable($name);

    /**
     * gets all file variables
     * @return array
     */
    public function getFiles();

    /**
     * gets file variable by name
     * @param $name string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getFileVariable($name);

    /**
     * gets all request headers
     * @return array
     */
    public function getHeaders();

    /**
     * gets header variable by name
     * @param $name string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getHeaderVariable($name);

    /**
     * gets all cookies
     * @return array
     */
    public function getCookies();

    /**
     * gets cookie variable by name
     * @param $name string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getCookieVariable($name);

    /**
     * gets all -server variables
     * @return array
     */
    public function getServerVariables();

    /**
     * gets server variable by name
     * @param $name string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getServerVariable($name);
}