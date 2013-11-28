<?php

namespace Astina\Bundle\TradedoublerBundle\Product;

class Product
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var ProductImage
     */
    protected $productImage;

    /**
     * @var Category[]
     */
    protected $categories;

    /**
     * @var string
     */
    protected $productUrl;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var integer
     */
    protected $sourceProductId;

    /**
     * @var integer
     */
    protected $ean;

    /**
     * @var string
     */
    protected $sku;

    /**
     * @var string
     */
    protected $upc;

    /**
     * @var string
     */
    protected $isbn;

    /**
     * @var string
     */
    protected $mpn;

    /**
     * @var string
     */
    protected $availability;

    /**
     * @var integer
     */
    protected $inStock;

    /**
     * @var string
     */
    protected $condition;

    /**
     * @var string
     */
    protected $brand;

    /**
     * @var string
     */
    protected $model;

    /**
     * @var string
     */
    protected $manufacturer;

    /**
     * @var string
     */
    protected $shippingCost;

    /**
     * @var string
     */
    protected $shortDescription;

    /**
     * @var string
     */
    protected $promoText;

    /**
     * @var string
     */
    protected $warranty;

    /**
     * @var string
     */
    protected $deliveryTime;

    /**
     * @var string
     */
    protected $weight;

    /**
     * @var string
     */
    protected $size;

    /**
     * @var string
     */
    protected $techSpecs;

    /**
     * @var array array(name => "Foo", value => "Bar")
     */
    protected $fields;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param \Astina\Bundle\TradedoublerBundle\Product\ProductImage $productImage
     */
    public function setProductImage($productImage)
    {
        $this->productImage = $productImage;
    }

    /**
     * @return \Astina\Bundle\TradedoublerBundle\Product\ProductImage
     */
    public function getProductImage()
    {
        return $this->productImage;
    }

    /**
     * @param Category[] $categories
     */
    public function setCategories(array $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param string $productUrl
     */
    public function setProductUrl($productUrl)
    {
        $this->productUrl = $productUrl;
    }

    /**
     * @return string
     */
    public function getProductUrl()
    {
        return $this->productUrl;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $sourceProductId
     */
    public function setSourceProductId($sourceProductId)
    {
        $this->sourceProductId = $sourceProductId;
    }

    /**
     * @return int
     */
    public function getSourceProductId()
    {
        return $this->sourceProductId;
    }

    /**
     * @param int $ean
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
    }

    /**
     * @return int
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $upc
     */
    public function setUpc($upc)
    {
        $this->upc = $upc;
    }

    /**
     * @return string
     */
    public function getUpc()
    {
        return $this->upc;
    }

    /**
     * @param string $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param string $mpn
     */
    public function setMpn($mpn)
    {
        $this->mpn = $mpn;
    }

    /**
     * @return string
     */
    public function getMpn()
    {
        return $this->mpn;
    }

    /**
     * @param string $availability
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;
    }

    /**
     * @return string
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * @param int $inStock
     */
    public function setInStock($inStock)
    {
        $this->inStock = $inStock;
    }

    /**
     * @return int
     */
    public function getInStock()
    {
        return $this->inStock;
    }

    /**
     * @param string $condition
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
    }

    /**
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $manufacturer
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shippingCost
     */
    public function setShippingCost($shippingCost)
    {
        $this->shippingCost = $shippingCost;
    }

    /**
     * @return string
     */
    public function getShippingCost()
    {
        return $this->shippingCost;
    }

    /**
     * @param string $promoText
     */
    public function setPromoText($promoText)
    {
        $this->promoText = $promoText;
    }

    /**
     * @return string
     */
    public function getPromoText()
    {
        return $this->promoText;
    }

    /**
     * @param string $warranty
     */
    public function setWarranty($warranty)
    {
        $this->warranty = $warranty;
    }

    /**
     * @return string
     */
    public function getWarranty()
    {
        return $this->warranty;
    }

    /**
     * @param string $deliveryTime
     */
    public function setDeliveryTime($deliveryTime)
    {
        $this->deliveryTime = $deliveryTime;
    }

    /**
     * @return string
     */
    public function getDeliveryTime()
    {
        return $this->deliveryTime;
    }

    /**
     * @param string $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param string $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $techSpecs
     */
    public function setTechSpecs($techSpecs)
    {
        $this->techSpecs = $techSpecs;
    }

    /**
     * @return string
     */
    public function getTechSpecs()
    {
        return $this->techSpecs;
    }

    /**
     * @param array $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }
} 