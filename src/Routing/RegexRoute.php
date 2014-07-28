<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 11:39 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Routing;


class RegexRoute implements Route {
    private $pattern;
    private $handler;
    private $arguments = array();

    /**
     * returns matched route handler
     * @return mixed
     */
    public function getHandler() {
        return $this->handler;
    }

    /**
     * gets associated array of uri arguments
     * @return array
     */
    public function getArguments() {
        return $this->arguments;
    }

    /**
     * determines if url matches route.
     * @param $uri string
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function match($uri) {
        if (!is_string($uri)) {
            throw new \InvalidArgumentException('RegexRoute::match expects parameter 1 to be string. '.gettype($uri).' given.');
        }

        if (!(bool)preg_match($this->pattern, $uri, $matches)) {
            return false;
        }

        foreach ($matches as $key => $val) {
            if (is_string($key)) {
                $this->arguments[$key] = $val;
            }
        }

        return true;
    }

    /**
     * @param $pattern string
     * @param $handler mixed
     * @throws \InvalidArgumentException
     * @internal param array $arguments
     */
    public function __construct($pattern, $handler) {
        if (!is_string($pattern)) {
            throw new \InvalidArgumentException('RegexRoute::__construct expects parameter 1 to be string. '.gettype($pattern).' given.');
        }

        $this->pattern = $pattern;
        $this->handler = $handler;
    }
}