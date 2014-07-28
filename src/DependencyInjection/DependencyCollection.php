<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 2:41 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\DependencyInjection;


interface DependencyCollection {
    /**
     * Registers dependency object.
     * @param $object
     * @param null|string $alias
     * @param null|Binder $binder
     * @return void
     */
    public function registerObject($object, $alias = null, $binder = null);

    /**
     * Returns object for type
     * @param $type string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getObject($type);

    /**
     * @param $type string
     * @param null|string $alias
     * @param bool $instantiatePerDependency
     * @param null|Binder $binder
     * @return mixed
     */
    public function registerDependency($type, $alias = null, $instantiatePerDependency = false, $binder = null);

    /**
     * Returns registered dependency for type
     * @param $type string
     * @return Dependency
     * @throws \InvalidArgumentException
     */
    public function getDependency($type);
}