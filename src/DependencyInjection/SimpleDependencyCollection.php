<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 3:22 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\DependencyInjection;


class SimpleDependencyCollection implements DependencyCollection {
    private $objects = array();
    private $dependencies = array();

    /**
     * Registers dependency object.
     * @param $object
     * @param null|string $alias
     * @param null $binder
     * @throws \InvalidArgumentException
     * @return void
     */
    public function registerObject($object, $alias = null, $binder = null) {
        if (!is_object($object)) {
            throw new \InvalidArgumentException('SimpleDependencyCollection::registerObject expects parameter 1 to be object. '.gettype($object).' given.');
        }

        if ($binder !== null && !($binder instanceof Binder)) {
            throw new \InvalidArgumentException('SimpleDependencyCollection::registerObject expects parameter 3 to be null or Binder. '.gettype($binder).' given.');
        }

        $alias = $alias ?: get_class($object);
        $this->objects[$alias] = $object;

        $dependency = new SimpleDependency(get_class($object), false, $binder);
        $this->dependencies[$alias] = $dependency;
    }

    /**
     * Returns object for type
     * @param $type string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getObject($type) {
        if (!is_string($type)) {
            throw new \InvalidArgumentException('SimpleDependencyCollection::getObject expects parameter 1 to be string. '.gettype($type).' given.');
        }

        return isset($this->objects[$type]) ? $this->objects[$type] : null;
    }

    /**
     * @param $type string
     * @param null|string $alias
     * @param bool $instantiatePerDependency
     * @param null $binder
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public function registerDependency($type, $alias = null, $instantiatePerDependency = false, $binder = null) {
        if (!is_string($type)) {
            throw new \InvalidArgumentException('SimpleDependencyCollection::registerDependency expects parameter 1 to be string. '.gettype($type).' given.');
        }

        if ($binder !== null && !($binder instanceof Binder)) {
            throw new \InvalidArgumentException('SimpleDependencyCollection::registerDependency expects parameter 4 to be null or Binder. '.gettype($binder).' given.');
        }

        $dependency = new SimpleDependency($type, $instantiatePerDependency, $binder);
        $alias = $alias ?: $type;

        $this->dependencies[$alias] = $dependency;
    }

    /**
     * Returns registered dependency for type
     * @param $type string
     * @return Dependency
     * @throws \InvalidArgumentException
     */
    public function getDependency($type) {
        if (!is_string($type)) {
            throw new \InvalidArgumentException('SimpleDependencyCollection::getDependency expects parameter 1 to be string. '.gettype($type).' given.');
        }

        return isset($this->dependencies[$type]) ? $this->dependencies[$type] : null;
    }
}