<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 4:18 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\DomainObjects;


class User {
    private $id;
    private $name;
    private $email;
    private $salt;
    private $password;

    /**
     * @return int|null
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param $id int
     * @throws \InvalidArgumentException
     */
    public function setId($id) {
        if (!is_int($id)) {
            throw new \InvalidArgumentException('User::setId expects parameter 1 to be int. '.gettype($id).' given.');
        }

        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param $name string
     * @throws \InvalidArgumentException
     */
    public function setName($name) {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('User::setName expects parameter 1 to be string. '.gettype($name).' given.');
        }

        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param $email string
     * @throws \InvalidArgumentException
     */
    public function setEmail($email) {
        if (!is_string($email)) {
            throw new \InvalidArgumentException('User::setEmail expects parameter 1 to be string. '.gettype($email).' given.');
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('email is invalid,');
        }

        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * @param $salt string
     * @throws \InvalidArgumentException
     */
    public function setSalt($salt) {
        if (!is_string($salt)) {
            throw new \InvalidArgumentException('User::setSalt expects parameter 1 to be string. '.gettype($salt).' given.');
        }

        $this->salt = $salt;
    }

    /**
     * @return string|null
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param $password string
     * @throws \InvalidArgumentException
     */
    public function setPassword($password) {
        if (!is_string($password)) {
            throw new \InvalidArgumentException('User::setPassword expects parameter 1 to be string. '.gettype($password).' given.');
        }

        $this->password = $password;
    }
}