<?php

namespace SecretSales\ReportTask\IntegrationTest\Bundle\ReportBundle\Command;

use SecretSales\ReportTask\Bundle\ReportBundle\Command\ReportCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use SecretSales\ReportTask\App\AppKernel;

/**
 * The integration test on the ReportCommand
 *
 * @date       23/06/2017
 * @time       22:44
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class ReportCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        self::bootKernel();

        $application = new Application(self::$kernel);

        $application->add(new ReportCommand());

        $command = $application->find('report:popular_words');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'number' => 100,
        ));

        $output = $commandTester->getDisplay();
        $this->assertSame('', $output);
    }

    protected static function getKernelClass()
    {
        return AppKernel::class;
    }
}