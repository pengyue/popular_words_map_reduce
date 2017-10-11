<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord;

use SecretSales\ReportTask\Bundle\ReportBundle\Model\PopularWord\StorageInterface;

class StorageService implements StorageServiceInterface
{
    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * Set the storage repository
     *
     * @param StorageInterface $storage
     * @return mixed
     */
    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Save the data into storage
     *
     * @param array $data
     *
     * @return bool
     */
    public function save(array $data)
    {
        return $this->storage->save($data);
    }
}