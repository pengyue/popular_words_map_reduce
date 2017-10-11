<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Command;

use JMS\Serializer\Tests\Fixtures\Order;
use SecretSales\ReportTask\Bundle\ReportBundle\Model\PopularWord\CsvStorage;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\Observer\NormalizeWordObserver;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\Observer\OrderWordObserver;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\Observer\SliceWordObserver;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\MapServiceInterface;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\ReduceServiceInterface;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\SplitTextServiceInterface;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\StorageServiceInterface;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\ReportServiceInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * The console command to generate the popular words report.
 *
 * php bin/console report:popular_words 100 (generate top 100 popular words list in a csv file)
 *
 * @date       09/10/2017
 * @time       10:13
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class ReportCommand extends ContainerAwareCommand
{
    use ContainerAwareTrait;

    /**
     * Configure the command parameters
     */
    protected function configure()
    {
        $this->setName('report:popular_words')
             ->setDescription('Generate the popular word report')
            ->addArgument(
                'number',
                InputArgument::OPTIONAL,
                'The x number of top popular words'
            );
    }

    /**
     * Pull the services together and run the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return bool
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $reportFilePath     = 'var/storage/report.csv';
        $number             = $input->getArgument('number');

        /** @var ReportServiceInterface $reportService */
        $reportService      = $this->getContainer()->get('app.popular_word_report_service');

        /** @var SplitTextServiceInterface $splitService */
        $splitService       = $this->getContainer()->get('app.popular_word_split_text_service');

        /** @var StorageServiceInterface $storageService */
        $storageService     = $this->getContainer()->get('app.popular_word_storage_service');

        /** @var MapServiceInterface $mapService */
        $mapService         = $this->getContainer()->get('app.popular_word_map_service');

        /** @var ReduceServiceInterface $reduceService */
        $reduceService      = $this->getContainer()->get('app.popular_word_reduce_service');

        $storage = new CsvStorage($reportFilePath);
        $storageService->setStorage($storage);

        $reportService->attach(new SliceWordObserver($number));
        $reportService->attach(new OrderWordObserver());
        $reportService->attach(new NormalizeWordObserver());

        $reportService->generate($splitService, $mapService, $reduceService, $storageService);

        echo sprintf('Csv report file has been generated at %s%s', $reportFilePath, PHP_EOL);
    }
}