<?php

namespace Astina\Bundle\TradedoublerBundle\Tracking;

class ProductListingConfig extends ContainerConfig
{
    protected $products;

    public function addProduct($id, $price, $name, $currency, $category = null)
    {
        $this->products[] = array(
            'id' => $id,
            'price' => $price,
            'name' => $name,
            'currency' => $currency,
            'category' => $category,
        );
    }

    public function addProducts($products)
    {
        foreach ($products as $product) {
            $this->addProduct(
                $product['id'],
                $product['price'],
                $product['name'],
                $product['currency'],
                isset($product['category']) ? $product['category'] : null
            );
        }
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function hasProducts()
    {
        return count($this->products) > 0;
    }
}