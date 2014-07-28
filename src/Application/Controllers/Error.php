<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 2:41 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Controllers;


use Twitter\Application\Presenters\NotFound;

class Error {
    public function notFound() {
        $presenter = new NotFound();

        return $presenter->getResponse();
    }
}