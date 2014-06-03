<?php

namespace Astina\Bundle\TradedoublerBundle\Tracking;

class ProductListingConfig extends ContainerConfig
{
    protected $products;

    public function addProduct($id, $price, $name, $currency)
    {
        $this->products[] = array(
            'id' => $id,
            'price' => $price,
            'name' => $name,
            'currency' => $currency,
        );
    }

    public function addProducts($products)
    {
        foreach ($products as $product) {
            $this->addProduct($product['id'], $product['price'], $product['name'], $product['currency']);
        }
    }

    public function hasProducts()
    {
        return count($this->products) > 0;
    }
}