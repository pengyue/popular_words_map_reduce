<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord;

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
     * @param SplitTextServiceInterface  $popularWordSplitTextService
     * @param MapServiceInterface        $popularWordMapService
     * @param ReduceServiceInterface     $popularWordReduceService
     * @param StorageServiceInterface    $popularWordStorageService
     * @param string                     $url
     *
     * @return bool
     */
    public function generate(
        SplitTextServiceInterface $popularWordSplitTextService,
        MapServiceInterface $popularWordMapService,
        ReduceServiceInterface $popularWordReduceService,
        StorageServiceInterface $popularWordStorageService,
        string $url
    );
}