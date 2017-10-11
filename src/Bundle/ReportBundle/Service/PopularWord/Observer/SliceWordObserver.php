<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\Observer;

/**
 * Splice the popular words
 *
 * @date       10/10/2017
 * @time       17:56
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class SliceWordObserver implements WordObserverInterface
{
    /**
     * The slice size for the popular words
     *
     * @var int
     */
    private $number;

    /**
     * SliceWordObserver constructor.
     * @param int $number
     */
    public function __construct(int $number)
    {
        $this->number = $number;
    }

    /**
     * Slice the result as required
     *
     * @param array $data
     * @return array|null
     */
    public function listenReportGeneration(array $data): ?array
    {
        return array_slice($data, 0, $this->number);
    }
}