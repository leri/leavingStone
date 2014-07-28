<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 5:56 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Binders;


use Twitter\DependencyInjection\Binder;
use Twitter\Http\Request;

class Login implements Binder {
    private $request;

    /**
     * Binds data to resolved object.
     * @param $resolvedObject \Twitter\Application\PresentationModels\Login
     * @return void
     * @throws \InvalidArgumentException
     */
    public function bind($resolvedObject) {
        if (!($resolvedObject instanceof \Twitter\Application\PresentationModels\Login)) {
            throw new \InvalidArgumentException('Login::bind expects argument 1 to be \Twitter\Application\PresentationModels\Login. '.gettype($resolvedObject).' given.');
        }

        $name = $this->request->getPostVariable('name');
        $password = $this->request->getPostVariable('password');

        $resolvedObject->setName($name);
        $resolvedObject->setPassword($password);
    }

    /**
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }
}