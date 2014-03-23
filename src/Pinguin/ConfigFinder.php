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
     * @return array
     */
    public static function getDirs(){
        return array(
            '.',
            '.' . DIRECTORY_SEPARATOR . 'config'
        );
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
        foreach($this->getDirs() as $dir){
            $result[] = realpath($baseDir . DIRECTORY_SEPARATOR . $dir);
        }
        return array_filter($result);
    }
}
