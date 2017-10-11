<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord;

/**
 * The currency service interface
 *
 * @date       10/10/2017
 * @time       18:57
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

interface ReduceServiceInterface
{
    /**
     * Combine and merge the map data into one final result
     *
     * @param array $data
     * @return ReduceServiceInterface
     */
    public function reduce(array $data): ReduceServiceInterface;

    /**
     * Get the reduced data
     *
     * @return null|array
     */
    public function getData(): ?array;
}