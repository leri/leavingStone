<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 7:29 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Repositories;


use Twitter\Application\DomainObjects\User;

class UserRepositoryImpl implements UserRepository {
    /* private */ const USER_SELECT_SQL = 'select `id`, `name`, `email`, `salt`, `password` from `users`';

    private $pdo;

    /**
     * @param $id int
     * @return User|null
     */
    public function getById($id) {
        $user = null;
        $sql = static::USER_SELECT_SQL.' where id=:id';
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute(array(':id' => $id)) && ($data = $stmt->fetch(\PDO::FETCH_ASSOC))) {
            $user = $this->createFromData($data);
        }

        return $user;
    }

    /**
     * @param $name string
     * @return User|null
     */
    public function getName($name) {
        $user = null;
        $sql = static::USER_SELECT_SQL.' where name=:name';
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute(array(':name' => $name)) && ($data = $stmt->fetch(\PDO::FETCH_ASSOC))) {
            $user = $this->createFromData($data);
        }

        return $user;
    }

    /**
     * @param User $user
     * @return void
     */
    public function insert(User $user) {
        $sql = 'insert into `users` values (:id, :name, :email, :salt, :password)';
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(
            ':id' => $user->getId(),
            ':name' => $user->getName(),
            ':email' => $user->getEmail(),
            ':salt' => $user->getSalt(),
            ':password' => $user->getPassword()
            ))) {

            $user->setId((int)$this->pdo->lastInsertId());
        }
    }

    /**
     * @param User $follower
     * @param User $following
     * @return void
     */
    public function addFollower(User $follower, User $following) {
        $followerId = $follower->getId();
        $followingId = $following->getId();

        $sql = 'insert into `followers` (`user_id`, `friend_id`) values (:user_id, :friend_id)';
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(array(
            ':user_id' => $followerId, ':friend_id' => $followingId
        ));
    }

    /**
     * @param User $follower
     * @param User $unfollowing
     * @return void
     */
    public function removeFollower(User $follower, User $unfollowing) {
        $followerId = $follower->getId();
        $unfollowingId = $unfollowing->getId();

        $sql = 'delete from `followers` where `user_id`=:user_id and `friend_id`=:friend_id';
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(array(
            ':user_id' => $followerId, ':friend_id' => $unfollowingId
        ));
    }

    /**
     * @param User $userId
     * @return array|void
     */
    public function getFollowedUsers($userId) {
        $sql = 'select `t`.`id`, `name`, `email`, `salt`, `password` from `users` as `t`
                join `followers` as `r` on (`t`.`id` = `r`.`friend_id`)
                where `r`.`user_id`=:userId';
        $stmt = $this->pdo->prepare($sql);
        $result = array();

        if ($stmt->execute(array(':userId' => $userId))) {
            while ($data = $stmt->fetch()) {
                $result[] = $this->createFromData($data);
            }
        }

        return $result;
    }

    /**
     * @param $userId int
     * @return array
     */
    public function getNotFollowedUsers($userId) {
        $sql = 'select `t`.`id`, `name`, `email`, `salt`, `password` from `users` as `t`
                left outer join `followers` as `r` on (`t`.`id` = `r`.`friend_id`)
                where `t`.`id`<>:userId and `r`.`id` is null';
        $stmt = $this->pdo->prepare($sql);
        $result = array();

        if ($stmt->execute(array(':userId' => $userId))) {
            while ($data = $stmt->fetch()) {
                $result[] = $this->createFromData($data);
            }
        }

        return $result;
    }

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param array $data
     * @return User
     */
    private function createFromData(array $data) {
        $id = (int)$data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $salt = $data['salt'];
        $password = $data['password'];

        $user = new User();
        $user->setId($id);
        $user->setName($name);
        $user->setEmail($email);
        $user->setSalt($salt);
        $user->setPassword($password);

        return $user;
    }
}