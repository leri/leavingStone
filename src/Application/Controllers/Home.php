<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 3:35 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Controllers;


use Twitter\Application\Presenters\HomePresenter;
use Twitter\Application\Presenters\Redirection;
use Twitter\Application\Services\TweetService;
use Twitter\Application\Services\UserService;
use Twitter\Helpers\UrlGenerator;

class Home extends BaseController {
    private $userService;
    private $tweetService;
    private $urlGenerator;

    public function index() {
        if (!$this->userService->isLogged()) {
            $loginUrl = $this->urlGenerator->getAbsoluteUrl('user/sign');
            return $this->redirect($loginUrl);
        }

        $me = $this->userService->getLoggedUser();
        $myTweet = $this->tweetService->getUserLastTweet($me);

        $presenter = new HomePresenter($this->urlGenerator);

        $presenter->setTitle('Home');
        $presenter->setMenu(array(
            array(
                'link' => $this->urlGenerator->getAbsoluteUrl(''),
                'text' => 'Home'
            ),
            array(
                'link' => $this->urlGenerator->getAbsoluteUrl('user/users'),
                'text' => 'Users'
            ),
            array(
                'link' => $this->urlGenerator->getAbsoluteUrl('user/logout'),
                'text' => 'Logout'
            )
        ), 0);

        if ($myTweet !== null) {
            $presenter->setMyTweet($myTweet);
        }

        return $presenter->getResponse();
    }

    public function __construct(UserService $userService, TweetService $tweetService, UrlGenerator $urlGenerator) {
        $this->userService = $userService;
        $this->tweetService = $tweetService;
        $this->urlGenerator = $urlGenerator;
    }
}