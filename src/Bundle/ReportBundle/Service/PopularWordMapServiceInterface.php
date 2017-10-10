<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service;

/**
 * The popular words map class interface
 *
 * @date       09/10/2017
 * @time       19:17
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

interface PopularWordMapServiceInterface
{

    /**
     * Read the file from local file or remote url
     *
     * @param string $path
     * @return mixed
     */
    public function map($path);
}