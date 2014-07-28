<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 11:58 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Validators;


use Twitter\Application\PresentationModels\Tweet;

interface TweetPresentationModelValidator {
    /**
     * @param Tweet $tweet
     * @return bool
     */
    public function isValid(Tweet $tweet);

    /**
     * @return array
     */
    public function getErrors();
}