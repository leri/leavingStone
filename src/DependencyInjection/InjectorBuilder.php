<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/26/14
 * Time: 3:34 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\DependencyInjection;


interface InjectorBuilder {
    /**
     * @param callable $dependencyCollector
     * @return Injector
     */
    public function build(callable $dependencyCollector);
}