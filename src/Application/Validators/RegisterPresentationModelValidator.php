<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 8:19 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Validators;


use Twitter\Application\PresentationModels\Registration;

interface RegisterPresentationModelValidator {
    /**
     * @param Registration $model
     * @return bool
     */
    public function isValid(Registration $model);

    /**
     * @return array
     */
    public function getErrors();
}