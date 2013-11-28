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
                    ->info('Service id of product source. Must implement "Astina\Bundle\TradedoublerBundle\Product\ProductSourceInterface"')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}