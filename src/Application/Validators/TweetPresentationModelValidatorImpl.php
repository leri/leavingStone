<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/28/14
 * Time: 12:01 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Validators;


use Twitter\Application\PresentationModels\Tweet;

class TweetPresentationModelValidatorImpl implements TweetPresentationModelValidator {
    private $errors = array();

    /**
     * @param Tweet $tweet
     * @return bool
     */
    public function isValid(Tweet $tweet) {
        $body = $tweet->getBody();

        if (empty($body)) {
            $this->errors['body'] = 'Tweet should not be empty.';
        } else if (mb_strlen($body) > 1024) {
            $this->errors['body'] = 'Tweet body should not exceed 1024 chars';
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