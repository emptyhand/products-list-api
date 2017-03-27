<?php

namespace AppBundle\DependencyInjection\Compiler;

use AppBundle\EnvKeyLoader;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CustomPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('lexik_jwt_authentication.key_loader.openssl');
        $definition->setClass(EnvKeyLoader::class);
    }
}