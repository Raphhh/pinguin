<?php
namespace Pinguin;

/**
 * Class ConsoleHelper
 * @package Pinguin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ConsoleHelper
{
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
