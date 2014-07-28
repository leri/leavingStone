<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 11:27 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Repositories;


use Twitter\Application\DomainObjects\Tweet;

class TweetRepositoryImpl implements TweetRepository {
    private $pdo;

    /**
     * @param $userId int
     * @return Tweet|null
     */
    public function getLastForUser($userId) {
        $userId = (int)$userId;
        $tweet = null;
        $sql = 'select `id`, `user_id`, `body` from `tweets` where `user_id`=:userId order by `id` desc limit 1';
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute(array(':userId' => $userId))) {
            if ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $tweet = $this->createFromData($data);
            }
        }

        return $tweet;
    }

    /**
     * @param $userId
     * @return array
     */
    public function getFriendTweets($userId) {
        $userId = (int)$userId;
        $sql = 'select `t`.`id`, `t`.`user_id`, `body` from `tweets` as `t`
                join `followers` as `r` on (`t`.`user_id` = `r`.`friend_id` and `r`.`user_id`=:userId)
                order by `t`.`id` desc';
        $result = array();
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute(array(':userId' => $userId))) {
            while ($data = $stmt->fetch()) {
                $result[] = $this->createFromData($data);
            }
        }

        return $result;
    }

    /**
     * @param Tweet $tweet
     * @return void
     */
    public function insertTweet(Tweet $tweet) {
        $sql = 'insert into `tweets` (`user_id`, `body`) values (:userId, :body)';
        $stmt = $this->pdo->prepare($sql);
        $parameters = array(
            ':userId' => $tweet->getAuthorId(),
            ':body' => $tweet->getBody()
        );

        if ($stmt->execute($parameters)) {
            $tweet->setId((int)$this->pdo->lastInsertId());
        }
    }

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    private function createFromData($data) {
        $tweet = new Tweet();

        $tweet->setId((int)$data['id']);
        $tweet->setAuthorId((int)$data['user_id']);
        $tweet->setBody($data['body']);

        return $tweet;
    }
}