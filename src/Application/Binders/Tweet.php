<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/28/14
 * Time: 12:18 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Binders;


use Twitter\DependencyInjection\Binder;
use Twitter\Http\Request;

class Tweet implements Binder {
    private $request;

    /**
     * Binds data to resolved object.
     * @param $resolvedObject \Twitter\Application\PresentationModels\Tweet
     * @return void
     * @throws \InvalidArgumentException
     */
    public function bind($resolvedObject) {
        if (!($resolvedObject instanceof \Twitter\Application\PresentationModels\Tweet)) {
            throw new \InvalidArgumentException();
        }

        $body = $this->request->getPostVariable('body');
        $resolvedObject->setBody($body);
    }

    public function __construct(Request $request) {
        $this->request = $request;
    }
}