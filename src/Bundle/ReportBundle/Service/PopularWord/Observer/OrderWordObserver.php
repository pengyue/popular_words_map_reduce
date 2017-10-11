<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\Observer;

/**
 * Order the popular words
 *
 * @date       10/10/2017
 * @time       17:56
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class OrderWordObserver implements WordObserverInterface
{
    /**
     * Listen to the report generation and apply the changes to data
     *
     * @param array $result
     *
     * @return null|array
     */
    public function listenReportGeneration(array $result): ?array
    {
        arsort($result);

        return $result;
    }
}