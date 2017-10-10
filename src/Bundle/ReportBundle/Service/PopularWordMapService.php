<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service;

use SecretSales\ReportTask\Bundle\ReportBundle\Model\Merchant;
use SecretSales\ReportTask\Bundle\ReportBundle\Model\TransactionTable;
use SecretSales\ReportTask\Bundle\ReportBundle\Utility\Helper;

/**
 * The popular words map class
 *
 * @date       10/09/2017
 * @time       19:17
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class PopularWordMapService implements PopularWordMapServiceInterface
{
    /**
     * default words byte size to reach in one chunk
     */
    const DEFAULT_CHUNK_SIZE = 8192;

    /**
     * Fetch the content into chunks
     *
     * @param string $url
     *
     * @return mixed
     */
    public function map($url)
    {
        $content = $this->read($url);

        $results = $this->notify($content, $currencyService);
    }

    /**
     * Read the file from remote url
     * TODO, move it to a Text Read Service
     *
     * @param string $url
     * @throws \Exception
     *
     * @return mixed
     */
    private function read($url)
    {
        $handle = fopen($url, "rb");

        if (false === $handle) {
            //TODO, add an exception
            throw new \Exception('Failed to open stream to URL');
        }

        $contents = [];

        while (!feof($handle)) {
            $contents[] = fread($handle, self::DEFAULT_CHUNK_SIZE);
        }

        fclose($handle);

        return $contents;
    }



}