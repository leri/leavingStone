<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 11:18 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Presenters;


use Twitter\Application\Presenter;
use Twitter\Http\DefaultResponse;
use Twitter\Http\Response;

class Json implements Presenter {
    private $data;

    /**
     * gets response object.
     * @return Response
     */
    public function getResponse() {
        $response = new DefaultResponse();

        $response->addHeader('content-type', 'application/json');
        $response->setBody(json_encode($this->data));

        return $response;
    }

    public function __construct($data) {
        $this->data = $data;
    }
}