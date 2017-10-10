<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service;

use SecretSales\ReportTask\Bundle\ReportBundle\Service\Observer\ReportObserverInterface;
use SecretSales\ReportTask\Bundle\ReportBundle\Model\PopularWordStorageInterface;

/**
 * The report service class for generating the report.
 * It use observer pattern to convert the currencies,
 * it also could introduce other observers such as email, fraud-check validation alert, etc
 *
 * @date       09/10/2017
 * @time       20:18
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class ReportService implements ReportServiceInterface
{
    /**
     * @var array|ReportObserverInterface[]
     */
    private $observers = [];

    /**
     * The report csv file path
     *
     * @var string
     */
    private $reportFilePath = 'var/storage/report.csv';

    /**
     * Generate the report
     *
     * @param PopularWordMapServiceInterface        $popularWordMapService
     * @param PopularWordReduceServiceInterface     $popularWordReduceService
     * @param PopularWordStorageInterface           $popularWordStorage
     * @param int                                   $number
     *
     * @return bool
     */
    public function generate(
        PopularWordMapServiceInterface $popularWordMapService,
        PopularWordReduceServiceInterface $popularWordReduceService,
        PopularWordStorageInterface $popularWordStorage,
        $number
    ) {
        $data = $popularWordMapService
            ->map('https://s3-eu-west-1.amazonaws.com/secretsales-dev-test/interview/flatland.txt')
            ->getReportData();

        return $transactionStorage->setData($results)->save($this->getReportFilePath());
    }

    /**
     * Set the report file path
     *
     * @param string $filePath
     *
     * @return $this
     */
    public function setReportFilePath($filePath)
    {
        $this->reportFilePath = $filePath;

        return $this;
    }

    /**
     * Get the csv file path
     *
     * @return string
     */
    public function getReportFilePath()
    {
        return $this->reportFilePath;
    }

    /**
     * Attach an observer for report generation
     *
     * @param ReportObserverInterface $observer
     *
     * @return $this
     */
    public function attach(ReportObserverInterface $observer)
    {
        $this->observers[] = $observer;

        return $this;
    }

    /**
     * detach an observer for report generation
     *
     * @param ReportObserverInterface $observer
     *
     * @return $this
     */
    public function detach(ReportObserverInterface $observer)
    {
        $key = array_search($observer, $this->observers);

        unset($this->observers[$key]);

        return $this;
    }

    /**
     * @param array           $data
     * @param CurrencyServiceInterface $currencyService
     *
     * @return array
     */
    public function notify(array $data, CurrencyServiceInterface $currencyService)
    {
        $result = [];
        foreach ($this->observers as $observer) {
            $result = $observer->listenReportGeneration($data, $currencyService);
        }

        return $result;
    }
}