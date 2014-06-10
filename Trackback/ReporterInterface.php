<?php

namespace Astina\Bundle\TradedoublerBundle\Trackback;

interface ReporterInterface
{
    /**
     * Params:
     *  - orderNumber
     *  - orderValue  (excl VAT and shipping)
     *  - currency
     *  - voucher
     *
     * @param array $params
     * @return void
     */
    function setReportParams(array $params);

    function getReportParams();

    function clearReportParams();
}