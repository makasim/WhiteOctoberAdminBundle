<?php

/*
 * This file is part of the WhiteOctoberAdminBundle package.
 *
 * (c) Pablo Díez <pablodip@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WhiteOctober\AdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Adds tagged white_october_admin.action services to the admin factory.
 *
 * @author Pablo Díez <pablodip@gmail.com>
 */
class AddActionsPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('white_october_admin.action_factory')) {
            return;
        }

        $actions = array();
        foreach ($container->findTaggedServiceIds('white_october_admin.action') as $serviceId => $arguments) {
            $actions[] = new Reference($serviceId);
        }

        $container->getDefinition('white_october_admin.action_factory')->addMethodCall('addActions', array($actions));
    }
}
