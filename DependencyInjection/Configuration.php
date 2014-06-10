<?php

namespace Astina\Bundle\TradedoublerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('astina_tradedoubler');

        $rootNode
            ->children()
                ->scalarNode('api_token')
                    ->isRequired()
                ->end()
                ->scalarNode('feed_id')
                    ->isRequired()
                ->end()
                ->scalarNode('product_source')
                    ->info('Service id of product source. Must implement "Astina\Bundle\TradedoublerBundle\Client\ProductSourceInterface".')
                ->end()
                ->arrayNode('tracking')
                    ->children()
                        ->scalarNode('container_tag_id')->end()
                    ->end()
                ->end()
                ->arrayNode('trackback')
                    ->children()
                        ->scalarNode('cookie_name')->defaultValue('TRADEDOUBLER')->end()
                        ->scalarNode('organization')->end()
                        ->scalarNode('pixel_base_url')->defaultValue('https://tbs.tradedoubler.com/report')->end()
                        ->scalarNode('redirect_default_url')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}