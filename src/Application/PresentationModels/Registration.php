<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 4:45 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\PresentationModels;


use Twitter\Application\DomainObjects\User;

class Registration {
    private $name;
    private $email;
    private $password;
    private $repeatedPassword;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getRepeatedPassword() {
        return $this->repeatedPassword;
    }

    public function setRepeatedPassword($repeatedPassword) {
        $this->repeatedPassword = $repeatedPassword;
    }

    /**
     * @return User
     */
    public function toDomainObject() { // massive SRP violation?
        $user = new User();

        $user->setName($this->name);
        $user->setEmail($this->email);

        return $user;
    }
}