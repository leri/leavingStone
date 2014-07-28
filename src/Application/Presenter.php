<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 2:38 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application;


use Twitter\Http\Response;

interface Presenter {
    /**
     * gets response object.
     * @return Response
     */
    public function getResponse();
}