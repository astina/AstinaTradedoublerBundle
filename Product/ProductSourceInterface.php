<?php

namespace Astina\Bundle\TradedoublerBundle\Product;

interface ProductSourceInterface
{
    /**
     * @param $id integer   your internal product id
     * @return Product[]
     */
    public function find($id);

    /**
     * @return Product[]
     */
    public function all();
}