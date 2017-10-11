<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord;

use SecretSales\ReportTask\Bundle\ReportBundle\Model\Merchant;
use SecretSales\ReportTask\Bundle\ReportBundle\Model\TransactionTable;

/**
 * The popular words map class
 *
 * @date       10/09/2017
 * @time       19:17
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class MapService implements MapServiceInterface
{
    /**
     * @var array
     */
    private $result = [];

    /**
     * Analyse the popular words in each chunks
     *
     * TODO, make it event-driven, so that the map events could be handled with RabbitMQ/ActiveMQ/Kafka for parallel mapping process
     *
     * @param array $data
     *
     * @return MapServiceInterface
     */
    public function map(array $data): MapServiceInterface
    {
        $contents = [];
        foreach ($data as $item) {
            $text = $this->stripContent($item);
            $words = explode(' ' , $text);
            $contents [] = $this->count($words);
        }

        $this->result = $contents;

        return $this;
    }

    /**
     * Get the mapped the data
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->result;
    }

    /**
     * Count each words appear times
     *
     * @param array $words
     * @return array
     */
    private function count(array $words): array
    {
        $result = [];
        foreach ($words as $word) {
            $word = strtolower($word);
            if (empty($word)) {
                continue;
            }

            if (!isset($result[$word])) {
                $result[$word] = 1;
            } else {
                $result[$word]++;
            }
        }

        return $result;
    }

    /**
     * Strip the special chars such as ' " , . etc, so that we can get english chars counts
     * TODO, this bit could be improved according to strip rules, also regex normally dont come wth good performance
     *
     * @param string $content
     * @return string
     */
    private function stripContent(string $content): string
    {
        return preg_replace('/[^A-Za-z0-9]/', ' ', $content);
    }
}