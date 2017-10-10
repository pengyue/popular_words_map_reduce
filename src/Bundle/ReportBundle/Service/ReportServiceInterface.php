<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service;

use SecretSales\ReportTask\Bundle\ReportBundle\Model\PopularWordStorageInterface;

/**
 * The report service interface
 *
 * @date       10/09/2017
 * @time       20:45
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

interface ReportServiceInterface
{
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
    );
}