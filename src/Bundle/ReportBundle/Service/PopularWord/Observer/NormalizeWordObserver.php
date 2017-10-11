<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\Observer;

/**
 * Normalize the words for output with given format in csv
 *
 * @date       10/10/2017
 * @time       17:56
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class NormalizeWordObserver implements WordObserverInterface
{
    /**
     * Normalize the data into format
     * [
     *  ['word1', 1001],
     *  ['word2', 1000],
     *  ....
     * ]
     *
     * @param array $data
     * @return array|null
     */
    public function listenReportGeneration(array $data): ?array
    {
        $result = [];
        foreach ($data as $word => $count) {
            $result[] = [$word, $count];
        }

        return $result;
    }
}