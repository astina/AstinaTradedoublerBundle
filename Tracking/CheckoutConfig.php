<?php

namespace Astina\Bundle\TradedoublerBundle\Tracking;

class CheckoutConfig extends BasketConfig
{
    protected $orderId;

    protected $orderValue;

    protected $currency;

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function setOrderValue($orderValue)
    {
        $this->orderValue = $orderValue;

        return $this;
    }

    public function getOrderValue()
    {
        return $this->orderValue;
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
}