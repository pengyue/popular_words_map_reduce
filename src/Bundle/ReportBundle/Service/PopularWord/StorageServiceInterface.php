<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord;

use SecretSales\ReportTask\Bundle\ReportBundle\Model\PopularWord\StorageInterface;

interface StorageServiceInterface
{
    /**
     * Set the storage repository
     *
     * @param StorageInterface $storage
     * @return mixed
     */
    public function setStorage(StorageInterface $storage);

    /**
     * Save the data into csv file
     *
     * @param array $data
     * @return mixed
     */
    public function save(array $data);
}