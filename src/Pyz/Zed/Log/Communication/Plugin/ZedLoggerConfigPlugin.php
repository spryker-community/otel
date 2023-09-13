<?php

namespace Pyz\Zed\Log\Communication\Plugin;

use Exception;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger;
use OpenTelemetry\Contrib\Logs\Monolog\Handler as OpenTelemetryHandler;
use OpenTelemetry\SDK\Logs\LoggerProviderFactory;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Log\LogConstants;
use Spryker\Zed\Log\Communication\Plugin\ZedLoggerConfigPlugin as SprykerZedLoggerConfigPlugin;

class ZedLoggerConfigPlugin extends SprykerZedLoggerConfigPlugin
{
    /**
     * @return array|HandlerInterface[]
     * @throws Exception
     */
    public function getHandlers(): array
    {
        return [...parent::getHandlers(), $this->createOpenTelemetryHandler()];
    }

    /**
     * @return HandlerInterface
     * @throws Exception
     */
    private function createOpenTelemetryHandler(): HandlerInterface
    {
        $openTelemetryLoggerProviderFactory = new LoggerProviderFactory();
        $logLevel = Config::get(LogConstants::LOG_LEVEL, Logger::INFO);

        return new OpenTelemetryHandler($openTelemetryLoggerProviderFactory->create(), $logLevel);
    }
}
