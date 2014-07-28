<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 3:19 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\DependencyInjection;


class SimpleDependency implements Dependency {
    private $instantiatePerDependency;
    private $type;
    private $binder;

    /**
     * determines if dependency should be instantiated per dependency or reused.
     * @return bool
     */
    public function instantiatePerDependency() {
        return $this->instantiatePerDependency;
    }

    /**
     * gets dependency type
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Returns if dependency has binder defined
     * @return bool
     */
    public function hasBinder() {
        return $this->binder !== null;
    }

    /**
     * Returns binder if for dependency
     * @return Binder
     * @throws \LogicException
     */
    public function getBinder() {
        if ($this->binder === null) {
            throw new \LogicException('dependency does not have binder.');
        }

        return $this->binder;
    }

    /**
     * @param $type
     * @param $instantiatePerDependency
     * @param $binder
     * @throws \InvalidArgumentException
     */
    public function __construct($type, $instantiatePerDependency, $binder) {
        if (!is_string($type)) {
            throw new \InvalidArgumentException('SimpleDependency::__construct expects parameter 1 to be string. '.gettype($type).' given.');
        }

        if (!is_bool($instantiatePerDependency)) {
            throw new \InvalidArgumentException('SimpleDependency::__construct expects parameter 2 to be bool. '.gettype($instantiatePerDependency).' given.');
        }

        if ($binder !== null && !($binder instanceof Binder)) {
            throw new \InvalidArgumentException('SimpleDependency::__construct expects parameter 3 to be Binder or null. '.gettype($binder).' given.');
        }

        $this->type = $type;
        $this->instantiatePerDependency = $instantiatePerDependency;
        $this->binder = $binder;
    }
}