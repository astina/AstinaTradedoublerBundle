<?php

namespace Astina\Bundle\TradedoublerBundle\Tracking;

class ProductPageConfig extends ContainerConfig
{
    protected $productId;

    protected $category;

    protected $brand;

    protected $productName;

    protected $productDescription;

    protected $price;

    protected $currency;

    protected $url;

    protected $imageUrl;

    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;

        return $this;
    }

    public function getProductDescription()
    {
        return $this->productDescription;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function isEmpty()
    {
        return $this->productId == null;
    }
} 