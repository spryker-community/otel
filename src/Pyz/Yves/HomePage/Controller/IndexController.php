<?php
declare(strict_types=1);

namespace Pyz\Yves\HomePage\Controller;

use Spryker\Shared\Log\LoggerTrait;
use SprykerShop\Yves\HomePage\Controller\IndexController as SprykerIndexController;

class IndexController extends SprykerIndexController
{
    use LoggerTrait;

    public function indexAction()
    {
        $this->getLogger()->info("Hear my scream!");

        return parent::indexAction();
    }
}
