<?php

namespace Astina\Bundle\TradedoublerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AstinaTradedoublerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $container->setParameter('astina_tradedoubler.api_token', $config['api_token']);
        $container->setParameter('astina_tradedoubler.feed_id', $config['feed_id']);

        if (isset($config['product_source'])) {
            $container->setAlias('astina_tradedoubler.product_source', $config['product_source']);
        }

        $container->setParameter('astina_tradedoubler.tracking.container_tag_id', isset($config['tracking']) ? $config['tracking']['container_tag_id'] : null);

        if (isset($config['trackback'])) {
            $container->setParameter('astina_tradedoubler.trackback.cookie_name', $config['trackback']['cookie_name']);
            $container->setParameter('astina_tradedoubler.trackback.organization', $config['trackback']['organization']);
            $container->setParameter('astina_tradedoubler.trackback.pixel_base_url', $config['trackback']['pixel_base_url']);
            $container->setParameter('astina_tradedoubler.trackback.redirect_default_url', $config['trackback']['redirect_default_url']);
            $container->setParameter('astina_tradedoubler.trackback.mail_sender', $config['trackback']['mail_sender']);
            $container->setParameter('astina_tradedoubler.trackback.mail_recipients', $config['trackback']['mail_recipients']);
            $container->setParameter('astina_tradedoubler.trackback.mail_data_folder', $config['trackback']['mail_data_folder']);
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}