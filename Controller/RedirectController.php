<?php

namespace Astina\Bundle\TradedoublerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;

class RedirectController extends Controller
{
    const COOKIE_LIFETIME = 365; // days

    public function redirectAction(Request $request)
    {
        $tdUid = $request->get('tduid');
        $url = $request->get('url', $this->getDefaultUrl());
        $cookieName = $this->getCookieName();

        $request->getSession()->set($cookieName, $tdUid);

        $response = $this->redirect($url);
        $response->headers->setCookie(new Cookie($cookieName, $tdUid, time() + (self::COOKIE_LIFETIME * 24 * 3600)));

        return $response;
    }

    private function getDefaultUrl()
    {
        return $this->container->getParameter('astina_tradedoubler.trackback.redirect_default_url');
    }

    private function getCookieName()
    {
        return $this->container->getParameter('astina_tradedoubler.trackback.cookie_name');
    }
}