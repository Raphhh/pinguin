<?php
namespace Pinguin;

/**
 * Class ConfigFinderTest
 * @package Pinguin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ConfigFinderTest extends \PHPUnit_Framework_TestCase
{

    public function testResolveDirPaths(){
        $configFinder = new ConfigFinder();
        $paths = $configFinder->resolveDirPaths($this->getResourcesDir());
        $this->assertSame(
            array(
                $this->getResourcesDir(),
                $this->getResourcesDir() . DIRECTORY_SEPARATOR . 'config'
            ),
            $paths
        );
    }

    public function testResolveDirPathsWrong(){
        $configFinder = new ConfigFinder();
        $paths = $configFinder->resolveDirPaths(__DIR__);
        $this->assertSame(
            array(
                __DIR__,
            ),
            $paths
        );
    }

    private function getResourcesDir(){
        return __DIR__ . DIRECTORY_SEPARATOR . 'resources';
    }
}
