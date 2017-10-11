<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord;

interface SplitTextServiceInterface
{
    /**
     * Read the text from url and split it into chunks
     *
     * @param string $url
     */
    public function chunk(string $url);
}