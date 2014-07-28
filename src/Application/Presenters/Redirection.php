<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 3:26 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Presenters;


use Twitter\Application\Presenter;
use Twitter\Http\DefaultResponse;
use Twitter\Http\Response;

class Redirection implements Presenter {
    private $url;

    /**
     * gets response object.
     * @return Response
     */
    public function getResponse() {
        $response = new DefaultResponse();

        $response->setStatusCode(302);
        $response->addHeader('location', $this->url);

        return $response;
    }

    public function __construct($url) {
        if (!is_string($url)) {
            throw new \InvalidArgumentException('Redirection::__construct expects parameter 1 to be string. '.gettype($url).' given.');
        }

        $this->url = $url;
    }
}