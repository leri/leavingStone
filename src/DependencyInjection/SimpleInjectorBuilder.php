<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 3:35 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\DependencyInjection;


class SimpleInjectorBuilder implements InjectorBuilder {
    /**
     * @param callable $dependencyCollector
     * @return Injector
     */
    public function build(callable $dependencyCollector) {
        $dependencyCollection = new SimpleDependencyCollection();

        $dependencyCollector($dependencyCollection);

        return new SimpleInjector($dependencyCollection);
    }
}