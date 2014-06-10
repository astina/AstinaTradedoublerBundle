<?php

namespace Astina\Bundle\TradedoublerBundle\Model;

class ProductCollection
{
    /**
     * @var Product[]
     */
    protected $products;

    function __construct(array $products = array())
    {
        $this->setProducts($products);
    }

    /**
     * @param Product[] $products
     */
    public function setProducts($products)
    {
        $uniqueProducts = array();
        $uniqueProductIds = array();

        foreach ($products as $product) {
            if (!in_array($product->getSourceProductId(), $uniqueProductIds)) {
                $uniqueProducts[] = $product;
                $uniqueProductIds[] = $product->getSourceProductId();
            }
        }

        $this->products = $uniqueProducts;
    }

    /**
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }
} 