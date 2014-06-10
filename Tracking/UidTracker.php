<?php

namespace Astina\Bundle\TradedoublerBundle\Tracking;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;

class UidTracker
{
    private $uid = null;

    private $cookieName;

    function __construct($cookieName)
    {
        $this->cookieName = $cookieName;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
            return;
        }

        $request = $event->getRequest();
        $session = $request->getSession();

        $uid = $session->get($this->cookieName);

        if (null == $uid) {
            $uid = $request->cookies->get($this->cookieName);
        }

        $this->uid = $uid;
    }

    public function getUid()
    {
        return $this->uid;
    }
} 