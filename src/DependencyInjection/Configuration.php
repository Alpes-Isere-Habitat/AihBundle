<?php

declare(strict_types=1);

namespace Aih\AihBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('aih');
        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('HAPPLYAPI_USER')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un compte pour HapplyApi.'
                    )
                ->end()
                ->scalarNode('HAPPLYAPI_PASSWORD')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un mot de passe pour HapplyApi.'
                    )
                ->end()
                ->scalarNode('HAPPLYAPI_URL')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'URL de l\'API de HapplyApi.'
                    )
                ->end()
                ->scalarNode('HAPPLYHAB_APPLICATION')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'application pour laquelle vous souhaitez utiliser HapplyHab.'
                    )
                ->end()
                ->scalarNode('HAPPLYHAB_USER')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un compte pour HapplyHab.'
                    )
                ->end()
                ->scalarNode('HAPPLYHAB_PASSWORD')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un mot de passe pour HapplyHab.'
                    )
                ->end()
                ->scalarNode('HAPPLYHAB_URL')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'URL de l\'API de HapplyHab.'
                    )
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}