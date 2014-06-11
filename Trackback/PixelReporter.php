<?php

namespace Astina\Bundle\TradedoublerBundle\Trackback;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Templating\EngineInterface;

class PixelReporter implements ReporterInterface
{
    protected $organization;

    protected $pixelBaseUrl;

    /**
     * @var \Symfony\Component\Templating\EngineInterface
     */
    protected $templating;

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var UidTracker
     */
    protected $uidTracker;

    const SESSION_VAR = 'astina_tradedoubler_report_params';

    public function __construct(UidTracker $uidTracker, EngineInterface $templating, $organization, $pixelBaseUrl)
    {
        $this->uidTracker = $uidTracker;
        $this->templating = $templating;
        $this->organization = $organization;
        $this->pixelBaseUrl = $pixelBaseUrl;
    }

    public function setReportParams(array $params)
    {
        if (null == $this->session) {
            throw new \Exception('Need session to store report params');
        }

        $this->session->set(self::SESSION_VAR, $params);
    }

    public function getReportParams()
    {
        return $this->session ? $this->session->get(self::SESSION_VAR, array()) : array();
    }

    public function clearReportParams()
    {
        if (null == $this->session) {
            throw new \Exception('Need session to store report params');
        }

        $this->session->remove(self::SESSION_VAR);
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $this->session = $event->getRequest()->getSession();
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        if (count($this->getReportParams()) == 0) {
            return;
        }

        $response = $event->getResponse();
        $request = $event->getRequest();

        // is 200 html response?
        if ($response->isRedirection()
            || $request->isXmlHttpRequest()
            || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html'))
            || 'html' !== $request->getRequestFormat()
        ) {
            return;
        }

        $this->injectTrackingPixel($response);

        $this->clearReportParams();
    }

    protected function injectTrackingPixel(Response $response)
    {
        $content = $response->getContent();

        if (false !== $pos = mb_strripos($content, '</body')) {
            $pixel = sprintf('<img src="%s" height="1" width="1" />', $this->getTrackingPixelUrl());
            $content = mb_substr($content, 0, $pos) . $pixel . mb_substr($content, $pos);
            $response->setContent($content);
        }
    }

    protected function getTrackingPixelUrl()
    {
        $defaults = array(
            'organization' => $this->organization,
//            'reportInfo' => $this->getReportInfo(),
        );

        if ($tdUid = $this->uidTracker->getUid()) {
            $defaults['tduid'] = $tdUid;
        }

        $params = array_merge($defaults, $this->getReportParams());

        return sprintf('%s?%s', $this->pixelBaseUrl, http_build_query($params, '', '&amp;'));
    }
}