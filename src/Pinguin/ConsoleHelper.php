<?php
namespace Pinguin;

use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
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
     * @param \Symfony\Component\Console\Command\Command[] $commands
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
     * Creates a helperSet for console.
     *
     * @param EntityManager $entityManager
     * @return HelperSet
     */
    public function createHelperSet(EntityManager $entityManager)
    {
        return new HelperSet(array(
            'db' => new ConnectionHelper($entityManager->getConnection()),
            'em' => new EntityManagerHelper($entityManager)
        ));
    }

    /**
     * Creates console from a config file.
     * Config file must instantiate two variables:
     *  - $entityManager
     *  - $commands
     *
     * @param string $configFile
     * @return Application
     */
    public function createConsoleFromConfig($configFile)
    {
        require $configFile;
        return $this->createConsole(
            $this->createHelperSet(
                isset($entityManager) ? $entityManager : null
            ),
            isset($commands) ? $commands : null
        );
    }

    /**
     * Creates console from a config directory.
     * This directory or its subdirectory "config" must contain a config file named "cli-config.php"
     *
     * @param $baseDir
     * @return Application
     * @throws \RuntimeException
     */
    public function createConsoleFromProject($baseDir)
    {
        $configFile = $this->findConfigFile($baseDir);
        if ($configFile) {
            return $this->createConsoleFromConfig($configFile);
        }
        throw new \RuntimeException(sprintf(
            'No config file founded in directory "%s".',
            $baseDir,
            ConfigFinder::FILE_NAME
        ));
    }

    /**
     * @param string $baseDir
     * @return string
     */
    private function findConfigFile($baseDir)
    {
        $configFinder = new ConfigFinder();
        return $configFinder->find($baseDir);
    }
}
