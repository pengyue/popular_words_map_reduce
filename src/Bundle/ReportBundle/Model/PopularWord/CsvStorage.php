<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Model\PopularWord;

use SecretSales\ReportTask\Bundle\ReportBundle\Exception\ReportFileSaveFailureException;
use League\Csv\Writer;

/**
 * The class to read data from CSV file, it is implemented from StorageInterface
 * and other implementation could introduced, for example, database, elasticsearch, API, etc
 *
 * @date       09/10/2017
 * @time       15:20
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class CsvStorage implements StorageInterface
{
    /**
     * The source csv file path
     *
     * @var string
     */
    private $csvFilePath;

    /**
     * CsvStorage constructor.
     *
     * @param string $csvFilePath
     */
    public function __construct($csvFilePath)
    {
        $this->csvFilePath  = $csvFilePath;

        if (!ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }
    }

    /**
     * Save the data into storage
     *
     * @param array $data
     *
     * @return bool
     */
    public function save(array $data): bool
    {
        try {
            if (file_exists($this->csvFilePath)) {
                @unlink($this->csvFilePath);
            }

            $csv = Writer::createFromPath($this->csvFilePath, 'a+');

            $csv->insertOne([
                'Popular_Word',
                'Count',
            ]);

            $csv->insertAll($data);
        } catch (\Exception $e) {
            throw new ReportFileSaveFailureException($this->csvFilePath);
        }

        return true;
    }
}