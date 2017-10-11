<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\Observer;

/**
 * The interface defines the default observer behaviours
 *
 * @date       10/10/2017
 * @time       18:01
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

interface WordObserverInterface
{
    /**
     * Listen to report generation
     *
     * @param array $data
     *
     * @return null|array
     */
    public function listenReportGeneration(array $data): ?array;
}