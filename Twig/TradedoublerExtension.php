<?php

namespace Astina\Bundle\TradedoublerBundle\Twig;

use Astina\Bundle\TradedoublerBundle\Tracking\BasketConfig;
use Astina\Bundle\TradedoublerBundle\Tracking\CheckoutConfig;
use Astina\Bundle\TradedoublerBundle\Tracking\CommonConfig;
use Astina\Bundle\TradedoublerBundle\Tracking\ProductListingConfig;
use Astina\Bundle\TradedoublerBundle\Tracking\ProductPageConfig;

class TradedoublerExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    private $environment;

    /**
     * @var CommonConfig
     */
    private $commonConfig;

    /**
     * @var ProductListingConfig
     */
    private $productListingConfig;

    /**
     * @var ProductPageConfig
     */
    private $productPageConfig;

    /**
     * @var BasketConfig
     */
    private $basketConfig;

    /**
     * @var CheckoutConfig
     */
    private $checkoutConfig;

    function __construct(CommonConfig $commonConfig,
                         ProductListingConfig $productListingConfig,
                         ProductPageConfig $productPageConfig,
                         BasketConfig $basketConfig,
                         CheckoutConfig $checkoutConfig)
    {
        $this->commonConfig = $commonConfig;
        $this->productListingConfig = $productListingConfig;
        $this->productPageConfig = $productPageConfig;
        $this->basketConfig = $basketConfig;
        $this->checkoutConfig = $checkoutConfig;
    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return array(
            'tradedoubler_common' => new \Twig_Function_Method($this, 'renderCommon', array('is_safe' => array('html'))),
            'tradedoubler_product_listing' => new \Twig_Function_Method($this, 'renderProductListing', array('is_safe' => array('html'))),
            'tradedoubler_product_page' => new \Twig_Function_Method($this, 'renderProductPage', array('is_safe' => array('html'))),
            'tradedoubler_basket' => new \Twig_Function_Method($this, 'renderBasket', array('is_safe' => array('html'))),
            'tradedoubler_checkout' => new \Twig_Function_Method($this, 'renderCheckout', array('is_safe' => array('html'))),
        );
    }

    public function renderCommon()
    {
        return $this->environment->render(
            'AstinaTradedoublerBundle:Container:common.html.twig',
            array('config' => $this->commonConfig)
        );
    }

    public function renderProductListing(array $products = null)
    {
        if ($products) {
            $this->productListingConfig->addProducts($products);
        }

        if (!$this->productListingConfig->hasProducts()) {
            return '';
        }

        return $this->environment->render(
            'AstinaTradedoublerBundle:Container:product_listing.html.twig',
            array('config' => $this->productListingConfig)
        );
    }

    public function renderProductPage()
    {
        if ($this->productPageConfig->isEmpty()) {
            return '';
        }

        return $this->environment->render(
            'AstinaTradedoublerBundle:Container:product_page.html.twig',
            array('config' => $this->productPageConfig)
        );
    }

    public function renderBasket()
    {
        if (!$this->basketConfig->hasProducts()) {
            return '';
        }

        return $this->environment->render(
            'AstinaTradedoublerBundle:Container:basket.html.twig',
            array('config' => $this->basketConfig)
        );
    }

    public function renderCheckout()
    {
        if (!$this->checkoutConfig->hasProducts()) {
            return '';
        }

        return $this->environment->render(
            'AstinaTradedoublerBundle:Container:checkout.html.twig',
            array('config' => $this->checkoutConfig)
        );
    }

    public function getName()
    {
        return 'astina_tradedoubler';
    }
}