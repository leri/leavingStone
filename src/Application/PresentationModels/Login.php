<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 4:51 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\PresentationModels;


class Login {
    private $name;
    private $password;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}