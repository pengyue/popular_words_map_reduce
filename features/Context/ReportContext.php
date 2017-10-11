<?php

namespace SecretSales\ReportTask\Behat\Context;

use SecretSales\ReportTask\Bundle\ReportBundle\Model\PopularWord\CsvStorage;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\MapServiceInterface;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\Observer\OrderWordObserver;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\Observer\SliceWordObserver;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\Observer\NormalizeWordObserver;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\ReduceServiceInterface;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\SplitTextService;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\MapService;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\ReduceService;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\SplitTextServiceInterface;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\StorageService;
use Behat\Behat\Context\Context;
use League\Csv\Reader;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\StorageServiceInterface;

/**
 * The behat context class for ReportTask
 *
 * @date       11/10/2017
 * @time       21:58
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class ReportContext implements Context
{
    /**
     * @var SplitTextServiceInterface
     */
    private $splitTextService;

    /**
     * @var MapServiceInterface
     */
    private $mapService;

    /**
     * @var ReduceServiceInterface
     */
    private $reduceService;

    /**
     * @var StorageServiceInterface
     */
    private $storageService;

    /**
     * @var array
     */
    private $mapData;

    public function __construct() {
        $this->splitTextService = new SplitTextService();
        $this->mapService       = new MapService();
        $this->reduceService    = new ReduceService();
        $this->storageService   = new StorageService();
        $this->storageService->setStorage(new CsvStorage('var/storage/test/report.csv'));
    }

    /**
     * @Given The target popular words text file could be fetched: :url
     */
    public function theTargetPopularWordsTextFileCouldBeFetched($url)
    {
        $chunks = $this->splitTextService->chunk($url);
        $mapService = $this->mapService->map($chunks);
        \PHPUnit_Framework_Assert::assertInstanceOf(MapService::class, $mapService);
        $this->mapData = $mapService->getData();
        \PHPUnit_Framework_Assert::assertInternalType('array', $this->mapData);
    }

    /**
     * @When I want to generate a report for top :number popular words
     */
    public function iWantToGenerateAReportForTopXNumberPopularWords($number)
    {
        $reduceData = $this->reduceService->reduce($this->mapData)->getData();
        $slice = new SliceWordObserver($number);
        $data = $slice->listenReportGeneration($reduceData);
        $order = new OrderWordObserver();
        $data = $order->listenReportGeneration($data);
        $normalizer = new NormalizeWordObserver();
        $data = $normalizer->listenReportGeneration($data);
        $success = $this->storageService->save($data);

        \PHPUnit_Framework_Assert::assertTrue($success);
    }

    /**
     * @Then I should see :total_row_count rows in the report csv file
     */
    public function iShouldSeePopularWordsCounting($total_row_count)
    {
        $csv = Reader::createFromPath('var/storage/report.csv');
        $csv->setDelimiter(',');
        $data = $csv->setOffset(0)->fetchAll();

        \PHPUnit_Framework_Assert::assertEquals($total_row_count, count($data));
    }

}
