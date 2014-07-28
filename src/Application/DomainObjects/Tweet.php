<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 11:19 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\DomainObjects;


class Tweet {
    private $id;
    private $authorId;
    private $body;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        if (!is_int($id)) {
            throw new \InvalidArgumentException('Tweet::setId expects parameter 1 to be int. '.gettype($id).' given.');
        }

        $this->id = $id;
    }

    public function getAuthorId() {
        return $this->authorId;
    }

    public function setAuthorId($authorId) {
        if (!is_int($authorId)) {
            throw new \InvalidArgumentException('Tweet::setAuthorId expects parameter 1 to be int. '.gettype($authorId).' given.');
        }

        $this->authorId = $authorId;
    }

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }
}