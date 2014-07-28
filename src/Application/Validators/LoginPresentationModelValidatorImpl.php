<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 7:15 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Validators;


use Twitter\Application\PresentationModels\Login;

class LoginPresentationModelValidatorImpl implements LoginPresentationModelValidator {
    private $errors = array();

    /**
     * @param Login $model
     * @return bool
     */
    public function isValid(Login $model) {
        $name = $model->getName();
        $password = $model->getPassword();

        if (empty($name)) {
            $this->errors['name'] = 'Name should not be empty.';
        }

        if (empty($password)) {
            $this->errors['password'] = 'Password should not be empty';
        }

        return !(bool)$this->errors;
    }

    /**
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }
}