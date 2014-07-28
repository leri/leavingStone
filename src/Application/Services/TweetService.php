<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 11:39 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Services;


use Twitter\Application\DomainObjects\Tweet;
use Twitter\Application\DomainObjects\User;

interface TweetService {
    /**
     * @param User $user
     * @return Tweet|null
     */
    public function getUserLastTweet(User $user);

    /**
     * @param User $user
     * @return Tweet|null
     */
    public function getFollowingTweets(User $user);

    /**
     * @param Tweet $tweet
     * @return void
     */
    public function tweet(Tweet $tweet);
}