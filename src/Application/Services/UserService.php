<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 6:21 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Services;


use Twitter\Application\DomainObjects\User;

interface UserService {
    const LOGIN_USER_NOT_FOUND = 1;
    const LOGIN_WRONG_PASSWORD = 2;
    const LOGIN_OK = 3;

    const REGISTER_ALREADY_EXISTS = 1;
    const REGISTER_OK = 2;

    /**
     * @return bool
     */
    public function isLogged();

    /**
     * @param $name string
     * @param $password string
     * @return int
     * @throws \InvalidArgumentException
     */
    public function login($name, $password);

    /**
     * @param User $user
     * @return int
     */
    public function register(User $user);

    /**
     * @return void
     */
    public function logout();

    /**
     * @return User
     */
    public function getLoggedUser();

    /**
     * @param $id int
     * @return User
     * @throws \InvalidArgumentException
     */
    public function getUserById($id);

    /**
     * @param $idToFollow int
     * @return void
     */
    public function follow($idToFollow);

    /**
     * @param $idToUnfollow int
     * @return void
     */
    public function unfollow($idToUnfollow);

    /**
     * @param $id
     * @return mixed
     */
    public function getNotFollowedUsers($id);

    /**
     * @param $id
     * @return mixed
     */
    public function getFollowedUsers($id);
}