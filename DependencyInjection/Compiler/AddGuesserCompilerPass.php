<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\DoctrinePHPCRAdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerInterface;

/*
 *
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 * @author Nacho Martín <nitram.ohcan@gmail.com>
 */
class AddGuesserCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {

        // ListBuilder
        $definition = $container->getDefinition('sonata.admin.guesser.doctrine_phpcr_list_chain');
        $services = array();
        foreach($container->findTaggedServiceIds('sonata.admin.guesser.doctrine_phpcr_list') as $id => $attributes) {
            $services[] = new Reference($id);
        }

        $definition->replaceArgument(0, $services);

        // ListBuilder
        $definition = $container->getDefinition('sonata.admin.guesser.doctrine_phpcr_datagrid_chain');
        $services = array();
        foreach($container->findTaggedServiceIds('sonata.admin.guesser.doctrine_phpcr_datagrid') as $id => $attributes) {
            $services[] = new Reference($id);
        }

        $definition->replaceArgument(0, $services);

        // ShowBuilder
        $definition = $container->getDefinition('sonata.admin.guesser.doctrine_phpcr_show_chain');
        $services = array();
        foreach($container->findTaggedServiceIds('sonata.admin.guesser.doctrine_phpcr_show') as $id => $attributes) {
            $services[] = new Reference($id);
        }

        $definition->replaceArgument(0, $services);
    }
}

