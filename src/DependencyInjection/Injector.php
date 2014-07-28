<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 1:49 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\DependencyInjection;


interface Injector {
    /**
     * Resolves object in DiC
     * @param $type string
     * @return mixed
     * @throws \InvalidArgumentException
     * @throws DependencyNotFoundException
     */
    public function resolveType($type);

    /**
     * Resolves object that's not in DiC and passes dependencies from DiC
     * @param $type string
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function resolveUnregistered($type);

    /**
     * @param $object
     * @param $methodName string
     * @param array $scalars
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function resolveMethodAndCall($object, $methodName, array $scalars = array());
}