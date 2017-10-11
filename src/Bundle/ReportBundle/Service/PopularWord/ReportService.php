<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord;

use SecretSales\ReportTask\Bundle\ReportBundle\Service\PopularWord\Observer\WordObserverInterface;

/**
 * The report service class for generating the report.
 *
 * @date       09/10/2017
 * @time       20:18
 * @author     Peng Yue <penyue@gmail.com>
 * @copyright  2004-2017 Peng Yue
 */

class ReportService implements ReportServiceInterface
{
    /**
     * The observer for ordering, notification (emailing), logging, etc
     * @var array|WordObserverInterface[]
     */
    private $observers = [];

    /**
     * Generate the report
     *
     * @param SplitTextServiceInterface  $popularWordSplitTextService
     * @param MapServiceInterface        $popularWordMapService
     * @param ReduceServiceInterface     $popularWordReduceService
     * @param StorageServiceInterface    $popularWordStorageService
     * @param string                     $url
     *
     * @return bool
     */
    public function generate(
        SplitTextServiceInterface $popularWordSplitTextService,
        MapServiceInterface $popularWordMapService,
        ReduceServiceInterface $popularWordReduceService,
        StorageServiceInterface $popularWordStorageService,
        string $url
    ) {
        $chunkData = $popularWordSplitTextService->chunk($url);

        //TODO, event-driven, and mapService worker could pick up mapping job in parallel, even better solution is to make the SplitTextService into event as well as mapService

        $mapData = $popularWordMapService->map($chunkData)->getData();

        $result = $popularWordReduceService->reduce($mapData);
        $words = $this->notify($result->getData());

        return $popularWordStorageService->save($words);
    }

    /**
     * Attach an observer for report generation
     *
     * @param WordObserverInterface $observer
     *
     * @return $this
     */
    public function attach(WordObserverInterface $observer)
    {
        $this->observers[] = $observer;

        return $this;
    }

    /**
     * detach an observer for report generation
     *
     * @param WordObserverInterface $observer
     *
     * @return $this
     */
    public function detach(WordObserverInterface $observer)
    {
        $key = array_search($observer, $this->observers);

        unset($this->observers[$key]);

        return $this;
    }

    /**
     * Run the attached observers
     *
     * @param array $data
     *
     * @return array
     */
    public function notify(array $data)
    {
        foreach ($this->observers as $observer) {
            $data = $observer->listenReportGeneration($data);
        }

        return $data;
    }
}