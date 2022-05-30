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
                ->scalarNode('HAPPLYSMS_URL')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'URL de l\'API de HapplySms.'
                    )
                ->end()
                ->scalarNode('HAPPLYSMS_USER')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un compte pour HapplySms.'
                    )
                ->end()
                ->scalarNode('HAPPLYSMS_PASSWORD')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un mot de passe pour HapplySms.'
                    )
                ->end()
                ->scalarNode('AZURE_TENANT_ID')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'ID de l\'organisation Azure.'
                    )
                ->end()
                ->scalarNode('AZURE_CLIENT_ID')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'ID du client Azure.'
                    )
                ->end()
                ->scalarNode('AZURE_CLIENT_SECRET')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier le secret du client Azure.'
                    )
                ->end()
                ->scalarNode('AZURE_GROUP_ALL_USER')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier le nom du groupe d\'utilisateurs Azure.'
                    )
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
