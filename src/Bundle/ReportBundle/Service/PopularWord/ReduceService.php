<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord;

/**
 * The popular words reduce process
 *
 * @date       09/10/2017
 * @time       18:49
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class ReduceService implements ReduceServiceInterface
{
    /**
     * @var array
     */
    private $result = [];

    /**
     * Combine and merge the map data into one final result
     *
     * @param array $data
     * @return ReduceServiceInterface
     */
    public function reduce(array $data): ReduceServiceInterface
    {
        foreach ($data as $wordList) {
            if (empty($wordList)) {
                continue;
            }
            foreach ($wordList as $word => $count) {
                $word = strtolower($word);
                if (!isset($this->result[$word])) {
                    $this->result[$word] = 1;
                } else {
                    $this->result[$word] += $count;
                }
            }
        }

        return $this;
    }

    /**
     * Get the reduced data
     *
     * @return null|array
     */
    public function getData(): ?array
    {
        return $this->result;
    }
}