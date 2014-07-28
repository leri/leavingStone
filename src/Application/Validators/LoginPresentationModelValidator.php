<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 7:14 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Validators;


use Twitter\Application\PresentationModels\Login;

interface LoginPresentationModelValidator {
    /**
     * @param Login $model
     * @return bool
     */
    public function isValid(Login $model);

    /**
     * @return array
     */
    public function getErrors();
}