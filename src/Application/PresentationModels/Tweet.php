<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 11:56 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\PresentationModels;


use Twitter\Application\DomainObjects\User;

class Tweet {
    /** @var User */
    private $author;
    private $body;

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
    }

    public function toArray() {
        return array(
            'author' => $this->author->getName(),
            'body' => $this->body
        );
    }
}