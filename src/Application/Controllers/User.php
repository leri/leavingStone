<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 4:42 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Controllers;


use Twitter\Application\PresentationModels\Login;
use Twitter\Application\PresentationModels\Registration;
use Twitter\Application\Presenters\Redirection;
use Twitter\Application\Presenters\Sign;
use Twitter\Application\Presenters\UsersPresenter;
use Twitter\Application\Services\UserService;
use Twitter\Application\Validators\LoginPresentationModelValidator;
use Twitter\Application\Validators\RegisterPresentationModelValidator;
use Twitter\Helpers\UrlGenerator;

class User extends BaseController {
    private $urlGenerator;
    private $userService;

    public function loginRegister() {
        if ($this->userService->isLogged()) {
            $homeUrl = $this->urlGenerator->getAbsoluteUrl('');
            return $this->redirect($homeUrl);
        }

        return $this->getSignFormResponse(array(), array());
    }

    public function login(Login $model, LoginPresentationModelValidator $validator) {
        if ($this->userService->isLogged()) {
            $homeUrl = $this->urlGenerator->getAbsoluteUrl('');
            return $this->redirect($homeUrl);
        }

        if (!$validator->isValid($model)) {
            $loginErrors = $validator->getErrors();

            return $this->getSignFormResponse($loginErrors, array(), $model, null);
        }

        $name = $model->getName();
        $password = $model->getPassword();
        $loginResult = $this->userService->login($name, $password);

        if ($loginResult === UserService::LOGIN_OK) {
            $url = $this->urlGenerator->getAbsoluteUrl('');

            return $this->redirect($url);
        }

        $loginErrors = array();

        switch ($loginResult) {
            case UserService::LOGIN_USER_NOT_FOUND:
                $loginErrors[] = 'Such user not found.';
                break;
            case UserService::LOGIN_WRONG_PASSWORD:
                $loginErrors[] = 'Password is wrong.';
                break;
        }

        return $this->getSignFormResponse($loginErrors, array(), $model, null);
    }

    public function register(Registration $model, RegisterPresentationModelValidator $validator) {
        if ($this->userService->isLogged()) {
            $homeUrl = $this->urlGenerator->getAbsoluteUrl('');
            return $this->redirect($homeUrl);
        }

        if (!$validator->isValid($model)) {
            $registrationErrors = $validator->getErrors();
            return $this->getSignFormResponse(array(), $registrationErrors, null, $model);
        }

        $salt = uniqid(mt_rand(), true); // good enough for demo.
        $password = hash('sha256', $salt.$model->getPassword());
        $user = $model->toDomainObject();
        $user->setSalt($salt);
        $user->setPassword($password);

        $registrationResult = $this->userService->register($user);

        if ($registrationResult === UserService::REGISTER_ALREADY_EXISTS) {
            $registrationErrors = array('Such user already exists.');
            return $this->getSignFormResponse(array(), $registrationErrors, null, $model);
        }

        $url = $this->urlGenerator->getAbsoluteUrl('');

        return $this->redirect($url);
    }

    public function logout() {
        $this->userService->logout();
        $url = $this->urlGenerator->getAbsoluteUrl('user/sign');

        return $this->redirect($url);
    }

    public function follow($id) {
        if (!$this->userService->isLogged()) {
            $url = $this->urlGenerator->getAbsoluteUrl('user/sign');

            return $this->redirect($url);
        }

        $id = (int)$id;
        $this->userService->follow($id);

        $url = $this->urlGenerator->getAbsoluteUrl('user/users');

        return $this->redirect($url);
    }

    public function unfollow($id) {
        if (!$this->userService->isLogged()) {
            $url = $this->urlGenerator->getAbsoluteUrl('user/sign');

            return $this->redirect($url);
        }

        $id = (int)$id;
        $this->userService->unfollow($id);
        $url = $this->urlGenerator->getAbsoluteUrl('user/users');

        return $this->redirect($url);
    }

    public function users() {
        if (!$this->userService->isLogged()) {
            $url = $this->urlGenerator->getAbsoluteUrl('user/sign');

            return $this->redirect($url);
        }

        $loggedUser = $this->userService->getLoggedUser();
        $userId = $loggedUser->getId();
        $unfollowedUsers = $this->userService->getNotFollowedUsers($userId);
        $followedUsers = $this->userService->getFollowedUsers($userId);

        $presenter = new UsersPresenter($this->urlGenerator);
        $presenter->setTitle('Users');
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
        ), 1);
        $presenter->setFollowedUsers($followedUsers);
        $presenter->setUnfollowedUsers($unfollowedUsers);

        return $presenter->getResponse();
    }

    public function __construct(UrlGenerator $urlGenerator, UserService $userService) {
        $this->urlGenerator = $urlGenerator;
        $this->userService = $userService;
    }

    private function getSignFormResponse(array $loginErrors, array $registrationErrors, $loginModel = null, $registrationModel = null) {
        $presenter = new Sign($this->urlGenerator, $loginErrors, $registrationErrors);

        if ($loginModel instanceof Login) {
            $presenter->setLoginModel($loginModel);
        }

        if ($registrationModel instanceof Registration) {
            $presenter->setRegistrationModel($registrationModel);
        }

        return $presenter->getResponse();
    }
}