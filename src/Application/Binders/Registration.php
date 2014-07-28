<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 6:10 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Binders;


use Twitter\DependencyInjection\Binder;
use Twitter\Http\Request;

class Registration implements Binder {
    private $request;

    /**
     * Binds data to resolved object.
     * @param $resolvedObject \Twitter\Application\PresentationModels\Registration
     * @return void
     * @throws \InvalidArgumentException
     */
    public function bind($resolvedObject) {
        if (!($resolvedObject instanceof \Twitter\Application\PresentationModels\Registration)) {
            throw new \InvalidArgumentException('Registration::bind expects parameter 1 to be \Twitter\Application\PresentationModels\Registration. '.gettype($resolvedObject).' given.');
        }

        $name = $this->request->getPostVariable('name');
        $email = $this->request->getPostVariable('email');
        $password = $this->request->getPostVariable('password');
        $repeatedPassword = $this->request->getPostVariable('repeated_password');

        $resolvedObject->setName($name);
        $resolvedObject->setEmail($email);
        $resolvedObject->setPassword($password);
        $resolvedObject->setRepeatedPassword($repeatedPassword);
    }

    public function __construct(Request $request) {
        $this->request = $request;
    }
}