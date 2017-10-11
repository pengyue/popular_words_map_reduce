<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord;

/**
 * The popular words map class interface
 *
 * @date       09/10/2017
 * @time       19:17
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

interface MapServiceInterface
{

    /**
     * Analyse the popular words in each chunks
     *
     * @param array $data
     *
     * @return mixed
     */
    public function map(array $data);

    /**
     * Get the mapped the data
     *
     * @return mixed
     */
    public function getData();
}