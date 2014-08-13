<?php

namespace Astina\Bundle\TradedoublerBundle\Client;

class TradedoublerException extends \Exception
{
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        if (is_array($message)) {
            $message = json_encode($message);
        }

        parent::__construct($message, $code, $previous);
    }
} 