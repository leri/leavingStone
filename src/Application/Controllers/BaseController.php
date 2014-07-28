<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 9:35 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Controllers;


use Twitter\Application\Presenters\Json;
use Twitter\Application\Presenters\Redirection;

abstract class BaseController {
    protected final function redirect($url) {
        if (!is_string($url)) {
            throw new \InvalidArgumentException(get_class($this).'::redirec expects parameter 1 to be string. '.gettype($url).' given.');
        }

        $presenter = new Redirection($url);
        return $presenter->getResponse();
    }

    protected final function json($data) {
        $presenter = new Json($data);
        return $presenter->getResponse();
    }
}