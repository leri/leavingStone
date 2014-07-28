<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 6:36 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Repositories;


use Twitter\Application\DomainObjects\User;

interface UserRepository {
    /**
     * @param $id int
     * @return User|null
     */
    public function getById($id);

    /**
     * @param $name string
     * @return User|null
     */
    public function getName($name);

    /**
     * @param User $user
     * @return void
     */
    public function insert(User $user);

    /**
     * @param User $follower
     * @param User $following
     * @return void
     */
    public function addFollower(User $follower, User $following);

    /**
     * @param User $follower
     * @param User $unfollowing
     * @return void
     */
    public function removeFollower(User $follower, User $unfollowing);

    /**
     * @param $userId int
     * @return array
     */
    public function getFollowedUsers($userId);

    /**
     * @param $userId int
     * @return array
     */
    public function getNotFollowedUsers($userId);
}