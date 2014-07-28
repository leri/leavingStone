<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 11:13 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Presenters;


use Twitter\Application\DomainObjects\Tweet;
use Twitter\Helpers\UrlGenerator;
use Twitter\Http\DefaultResponse;
use Twitter\Http\Response;

class HomePresenter extends BaseHeaderedPresenter {
    private $urlGenerator;
    private $myTweet;

    public function setMyTweet(Tweet $tweet) {
        $this->myTweet = $tweet;
    }

    /**
     * gets response object.
     * @return Response
     */
    public function getResponse() {
        $response = new DefaultResponse();

        ob_start();
        require_once TEMPLATE_DIR.'/home.php';
        $body = ob_get_clean();

        $response->setBody($body);

        return $response;
    }

    public function __construct(UrlGenerator $urlGenerator) {
        $this->urlGenerator = $urlGenerator;
    }
}