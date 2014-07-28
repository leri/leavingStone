<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 2:29 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\DependencyInjection;


interface Dependency {
    /**
     * determines if dependency should be instantiated per dependency or reused.
     * @return bool
     */
    public function instantiatePerDependency();

    /**
     * gets dependency type
     * @return string
     */
    public function getType();

    /**
     * Returns if dependency has binder defined
     * @return bool
     */
    public function hasBinder();

    /**
     * Returns binder if for dependency
     * @return Binder
     * @throws \LogicException
     */
    public function getBinder();
}