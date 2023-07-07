<?php

namespace Pyz\Yves\Log\Plugin;

use Monolog\Handler\HandlerInterface;
use Monolog\Logger;
use OpenTelemetry\Contrib\Logs\Monolog\Handler as OpentelemetryHandler;
use OpenTelemetry\SDK\Logs\LoggerProviderFactory;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Log\LogConstants;
use Spryker\Yves\Log\Plugin\YvesLoggerConfigPlugin as SprykerYvesLoggerConfigPlugin;

class YvesLoggerConfigPlugin extends SprykerYvesLoggerConfigPlugin
{
    /**
     * @return list<HandlerInterface>
     */
    public function getHandlers(): array
    {
        return [...parent::getHandlers(), $this->createOpentelemetryHandler()];
    }

    private function createOpentelemetryHandler(): HandlerInterface
    {
        $loggerProviderFactory = new LoggerProviderFactory();

        return new OpentelemetryHandler($loggerProviderFactory->create(), Config::get(LogConstants::LOG_LEVEL, Logger::INFO));
    }
}
