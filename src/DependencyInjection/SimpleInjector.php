<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 2:50 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\DependencyInjection;


class SimpleInjector implements Injector {
    private $dependencyCollection;

    /**
     * Resolves object in DiC
     * @param $type string
     * @return mixed
     * @throws \InvalidArgumentException
     * @throws DependencyNotFoundException
     */
    public function resolveType($type) {
        if (!is_string($type)) {
            throw new \InvalidArgumentException('SimpleInjector::resolveType expects parameter 1 to be string. '.gettype($type).' given.');
        }

        $dependency = $this->dependencyCollection->getDependency($type);

        if ($dependency === null) {
            throw new DependencyNotFoundException($type);
        }

        $instantiatePerDependency = $dependency->instantiatePerDependency();

        if (!$instantiatePerDependency) {
            $cachedObject = $this->dependencyCollection->getObject($type);

            if ($cachedObject !== null) {
                return $cachedObject;
            }
        }

        $actualType = $dependency->getType();
        $object = $this->createObjectFor($actualType);

        if (!$instantiatePerDependency) {
            $this->dependencyCollection->registerObject($object, $type);
        }

        if ($dependency->hasBinder()) {
            $binder = $dependency->getBinder();
            $binder->bind($object);
        }

        return $object;
    }

    /**
     * Resolves object that's not in DiC and passes dependencies from DiC
     * @param $type string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function resolveUnregistered($type) {
        if (!is_string($type)) {
            throw new \InvalidArgumentException('SimpleInjector::resolveUnregistered expects parameter 1 to be string. '.gettype($type).' given.');
        }

        return $this->createObjectFor($type);
    }

    /**
     * @param $object
     * @param $methodName string
     * @param array $scalars
     * @return mixed
     * @throws \InvalidArgumentException
     * @throws \LogicException
     */
    public function resolveMethodAndCall($object, $methodName, array $scalars = array()) {
        if (!is_object($object)) {
            throw new \InvalidArgumentException('SimpleInjector::resolveMethodAndCall expects parameter 1 to be object. '.gettype($object).' given.');
        }

        if (!is_string($methodName)) {
            throw new \InvalidArgumentException('SimpleInjector::resolveMethodAndCall expects parameter 2 to be string. '.gettype($methodName).' given.');
        }

        $reflected = new \ReflectionMethod($object, $methodName);

        if (!$reflected->isPublic()) {
            throw new \LogicException('Cannot call non-public method');
        }

        $parameters = $reflected->getParameters();
        $args = array();

        /** @var $parameter \ReflectionParameter */
        foreach ($parameters as $parameter) {
            $typeHintClass = $parameter->getClass();

            if ($typeHintClass === null) {
                $parameterName = $parameter->getName();

                if (!array_key_exists($parameterName, $scalars)) {
                    throw new \LogicException('Parameter value for: '.$parameterName.' is not provided');
                }

                $args[] = $scalars[$parameterName];
            } else {
                $typeHint = $typeHintClass->getName();
                $args[] = $this->resolveType($typeHint);
            }
        }

        return $reflected->invokeArgs($object, $args);
    }

    public function __construct(DependencyCollection $dependencyCollection) {
        $this->dependencyCollection = $dependencyCollection;
    }

    /**
     * @param $type string
     * @return object
     * @throws \LogicException
     */
    private function createObjectFor($type) {
        $reflected = new \ReflectionClass($type);

        if (!$reflected->isInstantiable()) {
            throw new \LogicException('Class should be instantiable while: '.$type.' is not.');
        }

        $constructor = $reflected->getConstructor();
        $args = array();

        if ($constructor !== null) {
            $ctorParameters = $constructor->getParameters();

            /** @var $parameter \ReflectionParameter */
            foreach ($ctorParameters as $parameter) {
                $typeHintClass = $parameter->getClass();

                if ($typeHintClass === null) {
                    throw new \LogicException('Cannot resolve parameter without type-hint.');
                }

                $typeHint = $typeHintClass->getName();
                $args[] = $this->resolveType($typeHint);
            }
        }

        return $reflected->newInstanceArgs($args);
    }
}