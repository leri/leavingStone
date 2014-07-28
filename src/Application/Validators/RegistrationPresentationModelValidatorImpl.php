<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 8:32 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Validators;


use Twitter\Application\PresentationModels\Registration;

class RegistrationPresentationModelValidatorImpl implements RegisterPresentationModelValidator {
    private $errors = array();

    /**
     * @param Registration $model
     * @return bool
     */
    public function isValid(Registration $model) {
        $name = $model->getName();
        $email = $model->getEmail();
        $password = $model->getPassword();
        $repeatedPassword = $model->getRepeatedPassword();

        if (empty($name)) {
            $this->errors['name'] = 'Name should not be empty';
        }

        if (empty($email)) {
            $this->errors['email'] = 'Email should not be empty';
        } else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors['email'] = 'Email is not valid.';
        }

        if (empty($password)) {
            $this->errors['password'] = 'Password should not be empty';
        }

        if ($repeatedPassword !== $password) {
            $this->errors['repeated_password'] = 'Repeated password does not match the original.';
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