<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 11:41 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Services;


use Twitter\Application\DomainObjects\Tweet;
use Twitter\Application\DomainObjects\User;
use Twitter\Application\Repositories\TweetRepository;

class TweetServiceImpl implements TweetService {
    private $tweetRepository;

    /**
     * @param User $user
     * @return Tweet|null
     */
    public function getUserLastTweet(User $user) {
        $userId = $user->getId();

        return $this->tweetRepository->getLastForUser($userId);
    }

    /**
     * @param User $user
     * @return Tweet|null
     */
    public function getFollowingTweets(User $user) {
        $id = $user->getId();

        return $this->tweetRepository->getFriendTweets($id);
    }

    /**
     * @param Tweet $tweet
     * @return void
     */
    public function tweet(Tweet $tweet) {
        $this->tweetRepository->insertTweet($tweet);
    }

    public function __construct(TweetRepository $tweetRepository) {
        $this->tweetRepository = $tweetRepository;
    }
}