<?php

namespace Astina\Bundle\TradedoublerBundle\Client;

use Astina\Bundle\TradedoublerBundle\Model\Product;

interface ProductSourceInterface
{
    /**
     * @param $id integer   your internal product id
     * @return Product[]
     */
    public function find($id);

    /**
     * Returns all products
     *
     * @return Product[]
     */
    public function all();

    /**
     * Returns the total amount of products
     *
     * @return int
     */
    public function count();

    /**
     * Returns a range of products.
     *
     * @param int $start      start index (from 0)
     * @param int $max
     * @return Product[]
     */
    public function from($start, $max);
}