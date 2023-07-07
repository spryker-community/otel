<?php

namespace Pyz\Shared\Application\Log\Config;

use Monolog\Handler\HandlerInterface;
use Monolog\Logger;
use OpenTelemetry\Contrib\Logs\Monolog\Handler as OpentelemetryHandler;
use OpenTelemetry\SDK\Logs\LoggerProviderFactory;
use Spryker\Shared\Application\Log\Config\SprykerLoggerConfig as SprykerSprykerLoggerConfig;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Log\LogConstants;

class SprykerLoggerConfig extends SprykerSprykerLoggerConfig
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
        dd($loggerProviderFactory);

        return new OpentelemetryHandler($loggerProviderFactory->create(), Config::get(LogConstants::LOG_LEVEL, Logger::INFO));
    }
}
