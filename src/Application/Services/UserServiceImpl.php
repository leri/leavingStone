<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 6:47 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Services;


use Twitter\Application\DomainObjects\User;
use Twitter\Application\Repositories\UserRepository;
use Twitter\Http\Session;

class UserServiceImpl implements UserService {
    private $session;
    private $userRepository;

    /**
     * @return bool
     */
    public function isLogged() {
        return $this->session->getVariable('user_id');
    }

    /**
     * @param $name string
     * @param $password string
     * @return int
     * @throws \InvalidArgumentException
     */
    public function login($name, $password) {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('UserServiceImpl::login expects parameter 1 to be string. '.gettype($name).' given.');
        }

        if (!is_string($password)) {
            throw new \InvalidArgumentException('UserServiceImpl::login expects parameter 2 to be string. '.gettype($password).' given.');
        }

        $user = $this->userRepository->getName($name);

        if ($user === null) {
            return UserService::LOGIN_USER_NOT_FOUND;
        }

        $salt = $user->getSalt();
        $hashedPassword = hash('sha256', $salt.$password);

        if ($hashedPassword !== $user->getPassword()) {
            return UserService::LOGIN_WRONG_PASSWORD;
        }

        $this->session->setVariable('user_id', $user->getId());

        return UserService::LOGIN_OK;
    }

    /**
     * @param User $user
     * @return int
     */
    public function register(User $user) {
        $tmpUser = $this->userRepository->getName($user->getName());

        if ($tmpUser !== null) {
            return UserService::REGISTER_ALREADY_EXISTS;
        }

        $this->userRepository->insert($user);
        $this->session->setVariable('user_id', $user->getId());

        return UserService::LOGIN_OK;
    }

    /**
     * @return void
     */
    public function logout() {
        $this->session->removeVariable('user_id');
    }

    /**
     * @return User
     */
    public function getLoggedUser() {
        $id = (int)$this->session->getVariable('user_id');

        return $this->userRepository->getById($id);
    }

    /**
     * @param $id int
     * @return User
     * @throws \InvalidArgumentException
     */
    public function getUserById($id) {
        return $this->userRepository->getById((int)$id);
    }

    /**
     * @param $idToFollow int
     * @return void
     */
    public function follow($idToFollow) {
        $following = $this->userRepository->getById((int)$idToFollow);
        $follower = $this->getLoggedUser();

        $this->userRepository->addFollower($follower, $following);
    }

    /**
     * @param $idToUnfollow int
     * @return void
     */
    public function unfollow($idToUnfollow) {
        $unfollowing = $this->userRepository->getById((int)$idToUnfollow);
        $follower = $this->getLoggedUser();

        $this->userRepository->removeFollower($follower, $unfollowing);
    }

    public function getNotFollowedUsers($id) {
        $users = $this->userRepository->getNotFollowedUsers((int)$id);

        return $users;
    }

    public function getFollowedUsers($id) {
        $users = $this->userRepository->getFollowedUsers((int)$id);

        return $users;
    }

    public function __construct(Session $session, UserRepository $userRepository) {
        $this->session = $session;
        $this->userRepository = $userRepository;
    }
}