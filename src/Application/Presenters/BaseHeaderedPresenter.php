<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 10:31 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Presenters;


use Twitter\Application\Presenter;

abstract class BaseHeaderedPresenter implements Presenter {
    protected $title;
    protected $menu;

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setMenu(array $menu, $selected) {
        $menu[$selected]['active'] = true;

        $this->menu = $menu;
    }
}