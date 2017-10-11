<?php

namespace SecretSales\ReportTask\IntegrationTest\Bundle\ReportBundle\Model;

use SecretSales\ReportTask\Bundle\ReportBundle\Model\PopularWord\CsvStorage;
use SecretSales\ReportTask\Bundle\ReportBundle\Model\PopularWord\StorageInterface;
use PHPUnit\Framework\TestCase;

/**
 * The test for the transaction data storage
 *
 * @date       10/10/2017
 * @time       19:06
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class CsvStorageTest extends TestCase
{
    const CSV_FILE_PATH = 'var/storage/data.csv';

    /**
     * @var StorageInterface
     */
    private $popularWordCsvStorage;

    public function setUp()
    {
        $this->popularWordCsvStorage = new CsvStorage(self::CSV_FILE_PATH);
    }

    /**
     * @expectedException \SecretSales\ReportTask\Bundle\ReportBundle\Exception\ReportFileSaveFailureException
     */
    public function testItCanThrowReportFileSavingFailureException()
    {
        $this->popularWordCsvStorage = new CsvStorage('/etc');
        $this->popularWordCsvStorage->save([1,2,3]);
    }

    public function testItCanSetData()
    {
        $this->assertTrue($this->popularWordCsvStorage->save([1,2,3]));
    }
}