<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 2:39 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Presenters;


use Twitter\Application\Presenter;
use Twitter\Http\DefaultResponse;
use Twitter\Http\Response;

class NotFound implements Presenter {
    /**
     * gets response object.
     * @return Response
     */
    public function getResponse() {
        $response = new DefaultResponse();

        $response->setStatusCode(404);

        ob_start();
        require_once TEMPLATE_DIR.'/not_found.php';
        $body = ob_get_clean();

        $response->setBody($body);

        return $response;
    }
}