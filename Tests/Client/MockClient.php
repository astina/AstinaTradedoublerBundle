<?php

namespace Astina\Bundle\TradedoublerBundle\Tests\Client;

use Astina\Bundle\TradedoublerBundle\Client\Client;
use Astina\Bundle\TradedoublerBundle\Client\TradedeoublerException;
use Astina\Bundle\TradedoublerBundle\Product\Product;
use Astina\Bundle\TradedoublerBundle\Product\ProductCollection;

class MockClient extends Client
{
    public function createProducts($products)
    {
        if (!($products instanceof ProductCollection)) {
            $products = new ProductCollection($products);
        }

        $this->logger->info('Creating/updating Tradedoubler products', array('ids' => $this->getSourceProductIds($products)));

        $json = $this->serializer->serialize($products, 'json');

        $this->logger->info('Data: ' . $json);
    }

    public function deleteProduct(Product $product)
    {
        $this->logger->info('Deleting Tradedoubler product', array('id' => $product->getSourceProductId()));
    }
} 