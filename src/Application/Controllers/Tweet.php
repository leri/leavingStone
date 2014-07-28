<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 11:56 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Controllers;


use Twitter\Application\Services\TweetService;
use Twitter\Application\Services\UserService;
use Twitter\Application\Validators\TweetPresentationModelValidator;
use Twitter\Helpers\UrlGenerator;

class Tweet extends BaseController {
    private $tweetService;
    private $userService;
    private $urlGenerator;

    public function post(\Twitter\Application\PresentationModels\Tweet $tweet, TweetPresentationModelValidator $validator) {
        if (!$this->userService->isLogged()) {
            $url = $this->urlGenerator->getAbsoluteUrl('user/sign');

            return $this->redirect($url);
        }

        if (!$validator->isValid($tweet)) {
            $url = $this->urlGenerator->getAbsoluteUrl('');
            return $this->redirect($url);
        }

        $me = $this->userService->getLoggedUser();
        $tweetDomain = new \Twitter\Application\DomainObjects\Tweet();
        $tweetDomain->setAuthorId($me->getId());
        $tweetDomain->setBody($tweet->getBody());

        $this->tweetService->tweet($tweetDomain);

        $url = $this->urlGenerator->getAbsoluteUrl('');
        return $this->redirect($url);
    }

    public function friendTweets() {
        $result = array('status' => 'ok');

        if (!$this->userService->isLogged()) {
            $result['status'] = 'not_logged';
            $result['data'] = $this->urlGenerator->getAbsoluteUrl('user/sign');

            return $this->json($result);
        }

        $me = $this->userService->getLoggedUser();
        $tweetsDomain = $this->tweetService->getFollowingTweets($me);

        $tweets = array();

        /** @var $tweetDomain \Twitter\Application\DomainObjects\Tweet */
        foreach ($tweetsDomain as $tweetDomain) {
            $tweet = new \Twitter\Application\PresentationModels\Tweet();

            $author = $this->userService->getUserById($tweetDomain->getAuthorId());
            $tweet->setBody($tweetDomain->getBody());
            $tweet->setAuthor($author);

            $tweets[] = $tweet->toArray(); // because PHP
        }

        $result['data'] = $tweets;

        return $this->json($result);
    }

    public function __construct(TweetService $tweetService, UserService $userService, UrlGenerator $urlGenerator) {
        $this->tweetService = $tweetService;
        $this->userService = $userService;
        $this->urlGenerator = $urlGenerator;
    }
}