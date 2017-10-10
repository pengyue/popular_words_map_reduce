<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Command;

use SecretSales\ReportTask\Bundle\ReportBundle\Model\Merchant;
use SecretSales\ReportTask\Bundle\ReportBundle\Model\TransactionCsvStorage;
use SecretSales\ReportTask\Bundle\ReportBundle\Model\TransactionTable;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\Observer\ReportObserver;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * The console command to generate the merchant transaction report.
 * It can filter by either merchant_id, date or both, the command format is
 *
 * php bin/console report:merchant                   (generate all the transaction)
 * php bin/console report:merchant 1                 (generate the transaction for merchant_id 1)
 * php bin/console report:merchant 1 01/05/2010      (generate the transactions for merchant_id 1 and on date 01/05/2010)
 * php bin/console report:merchant null 01/05/201    (generate the transactions only on 01/05/2010)
 *
 * @date       24/06/2017
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
        $merchantId         = $input->getArgument('popular_words');

        $reportService      = $this->getContainer()->get('app.report_service');
        $mapService         = $this->getContainer()->get('app.popular_word_map_service');
        $reduceService      = $this->getContainer()->get('app.popular_word_reduce_service');

//        $reportService->attach(new ReportObserver());
        $reportService->setReportFilePath($reportFilePath);
//        $merchantTransactionService->setTransactionRepository(new TransactionTable($dataFilePath));
//        $merchantTransactionService->setMerchantRepository(new Merchant());
//        $storage = new TransactionCsvStorage($dataFilePath);
//
//        $reportService->generate($merchantTransactionService, $currencyService, $storage, $merchantId);
//
//        echo sprintf('Csv report file has been generated at %s%s', $reportFilePath, PHP_EOL);
    }
}