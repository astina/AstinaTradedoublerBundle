<?php

namespace Astina\Bundle\TradedoublerBundle\Tracking;

abstract class ContainerConfig implements \IteratorAggregate, \Countable
{
    protected $containerTagId;

    function __construct($containerTagId)
    {
        $this->containerTagId = $containerTagId;
    }

    public function getContainerTagId()
    {
        return $this->containerTagId;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->toArray());
    }

    public function count()
    {
        return count($this->toArray());
    }

    protected function toArray()
    {
        $params = array();

        $class = new \ReflectionClass($this);
        foreach ($class->getProperties() as $prop) {
            $prop->setAccessible(true);
            $params[$prop->getName()] = $prop->getValue($this);
        }

        return $params;
    }
}