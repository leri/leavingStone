<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 11:18 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Repositories;


use Twitter\Application\DomainObjects\Tweet;

interface TweetRepository {
    /**
     * @param $userId int
     * @return Tweet|null
     */
    public function getLastForUser($userId);

    /**
     * @param $userId
     * @return array
     */
    public function getFriendTweets($userId);

    /**
     * @param Tweet $tweet
     * @return void
     */
    public function insertTweet(Tweet $tweet);
}