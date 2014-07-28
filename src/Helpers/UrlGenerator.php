<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 5:02 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Helpers;


interface UrlGenerator {
    /**
     * @param $path string
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getAbsoluteUrl($path);
}