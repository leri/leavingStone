<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 5:03 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Helpers;


class BasicUrlGenerator implements UrlGenerator {
    private $baseUrl;

    /**
     * @param $path string
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getAbsoluteUrl($path) {
        if (!is_string($path)) {
            throw new \InvalidArgumentException('BasicUrlGenerator::getAbsoluteUrl expects parameter 1 to be string. '.gettype($path).' given.');
        }

        return rtrim($this->baseUrl, '/').'/'.ltrim($path, '/');
    }

    public function __construct($baseUrl) {
        if (!is_string($baseUrl)) {
            throw new \InvalidArgumentException('BasicUrlGenerator::__construct expects parameter 1 to be string. '.gettype($baseUrl).' given.');
        }

        $this->baseUrl = $baseUrl;
    }
}