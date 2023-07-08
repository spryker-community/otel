<?php

namespace Pyz\Yves\Log\Plugin;

use Exception;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger;
use OpenTelemetry\Contrib\Logs\Monolog\Handler as OpenTelemetryHandler;
use OpenTelemetry\SDK\Logs\LoggerProviderFactory;
use OpenTelemetry\SDK\Registry;
use Pyz\Service\OpenTelemetry\ResourceDetector\SprykerResourceDetector;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Log\LogConstants;
use Spryker\Yves\Log\Plugin\YvesLoggerConfigPlugin as SprykerYvesLoggerConfigPlugin;

class YvesLoggerConfigPlugin extends SprykerYvesLoggerConfigPlugin
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
        Registry::registerResourceDetector('spryker', new SprykerResourceDetector());

        $openTelemetryLoggerProviderFactory = new LoggerProviderFactory();
        $logLevel = Config::get(LogConstants::LOG_LEVEL, Logger::INFO);

        return new OpenTelemetryHandler($openTelemetryLoggerProviderFactory->create(), $logLevel);
    }
}
