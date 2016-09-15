<?php

namespace Astina\Bundle\TradedoublerBundle\Client;

use Astina\Bundle\TradedoublerBundle\Model\Product;
use Astina\Bundle\TradedoublerBundle\Model\ProductCollection;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Psr\Log\LoggerInterface;

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

    const REQUEST_TIMEOUT = 30; // seconds

    function __construct(\Guzzle\Http\Client $guzzle, $feedId, LoggerInterface $logger)
    {
        $this->guzzle = $guzzle;
        $this->feedId = $feedId;
        $this->logger = $logger;
        $this->serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
            ->build()
        ;
    }

    /**
     * @param ProductCollection|Product[]|array $products
     * @throws TradedoublerException
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
            $json,
            array(
                'timeout' => self::REQUEST_TIMEOUT
            )
        );

        try {
            $response = $request->send()->json();
        } catch (\Exception $e) {
            $this->logger->critical('Error while sending Tradedoubler request: ' . $e->getCode() . $e);
            throw new TradedoublerException('Error while sending Tradedoubler request', $e->getCode(), $e);
        }

        if (!$response || count($response['errors']) > 0) {
            throw new TradedoublerException($response ? $response['errors'] : 'Error while sending Tradedoubler request');
        }
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
     * @throws TradedoublerException
     */
    public function deleteProduct(Product $product)
    {
        $this->logger->info('Deleting Tradedoubler product', array('id' => $product->getSourceProductId()));

        if (null == $product->getSourceProductId()) {
            throw new \InvalidArgumentException('Cannot delete product: no sourceProductId set');
        }

        $url = sprintf('products;fid=%s;spId=%s', $this->feedId, $product->getSourceProductId());

        $request = $this->guzzle->delete($url);


        try {
            $response = $request->send()->json();
        } catch (\Exception $e) {
            throw new TradedoublerException('Error while sending Tradedoubler request', $e->getCode(), $e);
        }

        if (!$response || count($response['errors']) > 0) {
            throw new TradedoublerException($response ? $response['errors'] : 'Error while sending Tradedoubler request');
        }
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