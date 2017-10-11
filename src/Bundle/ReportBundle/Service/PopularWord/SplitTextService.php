<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord;

class SplitTextService implements SplitTextServiceInterface
{
    /**
     * default words byte size to reach in one chunk
     */
    const DEFAULT_CHUNK_SIZE = 8192;

    /**
     * Read the text from url and split it into chunks
     *
     * @param string $url
     * @return array
     * @throws \Exception
     */
    public function chunk(string $url)
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