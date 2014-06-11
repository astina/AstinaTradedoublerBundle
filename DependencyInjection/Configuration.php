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
                ->scalarNode('api_token')->defaultNull()->end()
                ->scalarNode('feed_id')->defaultNull()->end()
                ->scalarNode('product_source')
                    ->info('Service id of product source. Must implement "Astina\Bundle\TradedoublerBundle\Client\ProductSourceInterface".')
                ->end()
                ->arrayNode('tracking')
                    ->children()
                        ->arrayNode('container_tag_ids')
                            ->children()
                                ->scalarNode('common')->defaultNull()->end()
                                ->scalarNode('product_listing')->defaultNull()->end()
                                ->scalarNode('product_page')->defaultNull()->end()
                                ->scalarNode('basket')->defaultNull()->end()
                                ->scalarNode('checkout')->defaultNull()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('trackback')
                    ->children()
                        ->scalarNode('cookie_name')->defaultValue('TRADEDOUBLER')->end()
                        ->scalarNode('organization')->end()
                        ->scalarNode('pixel_base_url')->defaultValue('https://tbs.tradedoubler.com/report')->end()
                        ->scalarNode('redirect_default_url')->end()
                        ->scalarNode('mail_sender')->end()
                        ->scalarNode('mail_recipients')->end()
                        ->scalarNode('mail_data_folder')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}