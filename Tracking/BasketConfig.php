<?php

namespace Astina\Bundle\TradedoublerBundle\Tracking;

class BasketConfig extends ContainerConfig
{
    protected $products;

    public function addProduct($id, $price, $name, $currency, $quantity)
    {
        $this->products[] = array(
            'id' => $id,
            'price' => $price,
            'name' => $name,
            'currency' => $currency,
            'qty' => $quantity,
        );
    }

    public function addProducts($products)
    {
        foreach ($products as $product) {
            $this->addProduct($product['id'], $product['price'], $product['name'], $product['currency'], $product['qty']);
        }
    }

    public function hasProducts()
    {
        return count($this->products) > 0;
    }
}