<?php

namespace Astina\Bundle\TradedoublerBundle\Client;

use Astina\Bundle\TradedoublerBundle\Product\Product;
use Astina\Bundle\TradedoublerBundle\Product\ProductCollection;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class Client
{
    /**
     * @var \Guzzle\Http\Client
     */
    protected $guzzle;

    protected $feedId;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    function __construct(\Guzzle\Http\Client $guzzle, $feedId, SerializerInterface $serializer, LoggerInterface $logger)
    {
        $this->guzzle = $guzzle;
        $this->feedId = $feedId;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    /**
     * @param ProductCollection|Product[]|array $products
     */
    public function createProducts($products)
    {
        if (!($products instanceof ProductCollection)) {
            $products = new ProductCollection($products);
        }
        
        $this->logger->info('Creating/updating Tradedoubler products', array('ids' => $this->getSourceProductIds($products)));

        $url = sprintf('products;fid=%s', $this->feedId);

        $json = $this->serializer->serialize($products, 'json');

        $request = $this->guzzle->post(
            $url,
            array(
                'content-type' => 'application/json; charset=utf-8',
            ),
            $json
        );
        $request->send();
    }

    /**
     * Create or update product information
     *
     * @param Product $product
     */
    public function createProduct(Product $product)
    {
        $this->createProducts(array($product));
    }

    /**
     * Delete product information
     *
     * @param Product $product
     * @throws \InvalidArgumentException
     */
    public function deleteProduct(Product $product)
    {
        $this->logger->info('Deleting Tradedoubler product', array('id' => $product->getSourceProductId()));

        if (null == $product->getSourceProductId()) {
            throw new \InvalidArgumentException('Cannot delete product: no sourceProductId set');
        }

        $url = sprintf('products;fid=%s;spId=%s', $this->feedId, $product->getSourceProductId());

        $request = $this->guzzle->delete($url);
        $request->send();
    }

    protected function getSourceProductIds(ProductCollection $products)
    {
        $ids = array();

        foreach ($products->getProducts() as $product) {
            $ids[] = $product->getSourceProductId();
        }

        return $ids;
    }
}