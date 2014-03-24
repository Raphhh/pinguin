<?php
namespace Pinguin;

/**
 * Class ConfigFinder
 * @package Pinguin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ConfigFinder
{
    /**
     * Name of the config file.
     */
    const FILE_NAME = 'cli-config.php';

    /**
     * Indicates location of possibles config directories.
     *
     * @return string[]
     */
    public static function getDirs()
    {
        return array(
            '.',
            '.' . DIRECTORY_SEPARATOR . 'config'
        );
    }

    /**
     * Finds a config file among possible directories.
     *
     * @param $baseDir
     * @return string
     */
    public function find($baseDir)
    {
        foreach ($this->resolveDirPaths($baseDir) as $directory) {
            $configFile = $this->getFilePath($directory);
            if (is_readable($configFile)) {
                return $configFile;
            }
        }
        return '';
    }

    /**
     * Resolves directories config according to $baseDir.
     *
     * @param $baseDir
     * @return array
     */
    public function resolveDirPaths($baseDir)
    {
        $result = array();
        foreach ($this->getDirs() as $dir) {
            $result[] = realpath($baseDir . DIRECTORY_SEPARATOR . $dir);
        }
        return array_filter($result);
    }

    /**
     * Concats $directory and file name.
     *
     * @param $directory
     * @return string
     */
    private function getFilePath($directory)
    {
        return $directory . DIRECTORY_SEPARATOR . self::FILE_NAME;
    }
}
