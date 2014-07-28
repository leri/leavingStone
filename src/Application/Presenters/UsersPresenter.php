<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 10:26 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Presenters;


use Twitter\Helpers\UrlGenerator;
use Twitter\Http\DefaultResponse;
use Twitter\Http\Response;

class UsersPresenter extends BaseHeaderedPresenter {
    private $urlGenerator;
    private $followedUsers = array();
    private $unfollowedUsers = array();

    public function setFollowedUsers(array $followedUsers) {
        $this->followedUsers = $followedUsers;
    }

    public function setUnfollowedUsers(array $unfollowedUsers) {
        $this->unfollowedUsers = $unfollowedUsers;
    }

    /**
     * gets response object.
     * @return Response
     */
    public function getResponse() {
        $response = new DefaultResponse();

        ob_start();
        require_once TEMPLATE_DIR.'/users.php';
        $body = ob_get_clean();

        $response->setBody($body);

        return $response;
    }

    public function __construct(UrlGenerator $urlGenerator) {
        $this->urlGenerator = $urlGenerator;
    }
}