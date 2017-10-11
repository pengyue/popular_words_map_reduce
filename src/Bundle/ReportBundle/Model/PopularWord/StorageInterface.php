<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Model\PopularWord;

/**
 * The storage interface.
 * It is an abstract layer for multiple data access storage like DB, csv, remote api, etc
 *
 * @date       10/10/2017
 * @time       14:04
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

interface StorageInterface
{
    /**
     * Save the data into storage
     *
     * @param array $data
     *
     * @return bool
     */
    public function save(array $data);
}