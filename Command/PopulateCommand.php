<?php

namespace Astina\Bundle\TradedoublerBundle\Command;

use Astina\Bundle\TradedoublerBundle\Client\Client;
use Astina\Bundle\TradedoublerBundle\Client\ProductSourceInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PopulateCommand extends ContainerAwareCommand
{
    const BATCH_SIZE_DEFAULT = 50;

    protected function configure()
    {
        $this
            ->setName('astina:tradedoubler:populate')
            ->setDescription('Sends product information to Tradedoubler API')
            ->addOption('batch_size', null, InputOption::VALUE_REQUIRED, 'How many products should be sent at once.', self::BATCH_SIZE_DEFAULT)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $batchSize = $input->getOption('batch_size');

        $container = $this->getContainer();

        /** @var ProductSourceInterface $productSource */
        $productSource = $container->get('astina_tradedoubler.product_source');
        if (!($productSource instanceof ProductSourceInterface)) {
            throw new \Exception('Product source has to implement Astina\Bundle\TradedoublerBundle\Product\ProductSourceInterface');
        }

        /** @var Client $client */
        $client = $container->get('astina_tradedoubler.client');

        /** @var ProgressHelper $progress */
        $progress = $this->getHelper('progress');

        $count = $productSource->count();
        $progress->start($output, $count);

        $index = 0;
        while ($index < $count) {

            $products = $productSource->from($index, $batchSize);
            $client->createProducts($products);

            $progress->advance($batchSize);

            $index += $batchSize;
        }

        $progress->finish();
    }
} 