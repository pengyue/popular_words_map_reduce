<?php

namespace SecretSales\ReportTask\UnitTest\Bundle\ReportBundle\Service;

use PHPUnit\Framework\TestCase;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\MapService;
use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\MapServiceInterface;

class MapServiceTest extends TestCase
{
    /**
     * @var MapServiceInterface
     */
    private $mapService;

    public function setUp()
    {
        $this->mapService = new MapService();
    }

    public function testItCanMap()
    {
        $this->assertInstanceOf(
            MapServiceInterface::class,
            $this->mapService->map(
            [
                '1231423ds&£!"4A',
                '134trqw',
                'dfbr£$eb3rgv.1/'
            ])
        );
    }

    public function testItCanStripe()
    {
        $this->assertEquals(
            [
                [
                    'cd' => 1,
                    '4a' => 1
                ],
                [
                    '134trqw' => 1
                ],
                [
                    'df' => 1,
                    12 => 1
                ]
            ],
            $this->mapService->map(
                [
                    'cD&£!"4A',
                    '134trqw',
                    'df.,12/'
            ])->getData()
        );
    }

    public function testItCanGetResult()
    {
        $this->assertSame([], $this->mapService->getData());
    }
}