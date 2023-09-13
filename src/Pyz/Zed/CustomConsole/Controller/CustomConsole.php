<?php
declare(strict_types=1);

namespace Pyz\Zed\CustomConsole\Controller;

use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomConsole extends Console
{
    use LoggerTrait;

    /**
     * @var string
     */
    public const COMMAND_NAME = 'custom:console';

    /**
     * @var string
     */
    public const COMMAND_DESCRIPTION = 'Custom console to log';

    protected function configure()
    {
        parent::configure();
        $this
            ->setName(static::COMMAND_NAME)
            ->setDescription(static::COMMAND_DESCRIPTION)
            ->setHelp('<info>' . static::COMMAND_NAME . ' -h</info>');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->getLogger()->info("console is started");

        for ($i=0; $i<10; $i++) {
            $this->getLogger()->info("Log me, $i");
        }

        $this->getLogger()->info("console is stopped");
        return static::CODE_SUCCESS;
    }
}
