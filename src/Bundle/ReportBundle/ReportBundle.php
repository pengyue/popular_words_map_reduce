<?php

namespace SecretSales\ReportTask\Bundle\ReportBundle;

use SecretSales\ReportTask\Bundle\ReportBundle\DependencyInjection\ApiExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * The base class for the BaseReportBundle, it belongs to customized symfony framework
 */
class ReportBundle extends Bundle
{

    /**
     * @var string
     */
    protected $name = 'ReportBundle';

    /**
     * @return string
     */
    public function getPath()
    {
        return __DIR__;
    }

    /**
     * @return ExtensionInterface
     */
    public function getContainerExtension()
    {
        if ($this->extension === null) {
            $this->extension = new ApiExtension();
        }

        return $this->extension;
    }

    /**
     * @return string
     */
    public function getContainerExtensionClass()
    {
        return ApiExtension::class;
    }

}
