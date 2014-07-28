<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 12:22 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\DependencyInjection;


interface Binder {
    /**
     * Binds data to resolved object.
     * @param $resolvedObject object
     * @return void
     * @throws \InvalidArgumentException
     */
    public function bind($resolvedObject);
}