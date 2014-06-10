<?php

namespace Astina\Bundle\TradedoublerBundle\Model;

class Transaction
{
    private $eventId;

    private $orderNumber;

    private $status;

    const STATUS_ACCEPTED = 'A';
    const STATUS_DENIED = 'D';

    private $reasonId;

    /**
     * @param mixed $eventId
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * @return mixed
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @param mixed $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $reasonId
     */
    public function setReasonId($reasonId)
    {
        $this->reasonId = $reasonId;
    }

    /**
     * @return mixed
     */
    public function getReasonId()
    {
        return $this->reasonId;
    }


} 