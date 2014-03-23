<?php
namespace Pinguin;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Class ConsoleHelper
 * @package Pinguin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ConsoleHelper
{

    /**
     * @return string
     */
    protected function getName()
    {
        return 'Pinguin Command Line Interface';
    }

    /**
     * @return string
     */
    protected function getVersion()
    {
        return '1';
    }

    /**
     * Creates console.
     *
     * @param HelperSet $helperSet
     * @param array $commands
     * @return Application
     */
    public function createConsole(HelperSet $helperSet, array $commands)
    {
        $cli = new Application($this->getName(), $this->getVersion());
        $cli->setCatchExceptions(true);
        $cli->setHelperSet($helperSet);
        $cli->addCommands($commands);
        return $cli;
    }

    /**
     * @param $baseDir
     * @return string
     */
    private function findConfigFile($baseDir)
    {
        $configFinder = new ConfigFinder();
        return $configFinder->find($baseDir);
    }
}
