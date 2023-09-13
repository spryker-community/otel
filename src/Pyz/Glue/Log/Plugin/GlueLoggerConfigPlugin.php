<?php

namespace Pyz\Glue\Log\Plugin;

use Exception;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger;
use OpenTelemetry\Contrib\Logs\Monolog\Handler as OpenTelemetryHandler;
use OpenTelemetry\SDK\Logs\LoggerProviderFactory;
use Spryker\Glue\Log\Plugin\GlueLoggerConfigPlugin as SprykerGlueLoggerConfigPlugin;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Log\LogConstants;

class GlueLoggerConfigPlugin extends SprykerGlueLoggerConfigPlugin
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
