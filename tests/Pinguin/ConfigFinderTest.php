<?php
namespace Pinguin;

/**
 * Class ConfigFinderTest
 * @package Pinguin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ConfigFinderTest extends \PHPUnit_Framework_TestCase
{

    public function testResolveDirPaths()
    {
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

    public function testResolveDirPathsWrong()
    {
        $configFinder = new ConfigFinder();
        $paths = $configFinder->resolveDirPaths(__DIR__);
        $this->assertSame(
            array(
                __DIR__,
            ),
            $paths
        );
    }

    public function testFind()
    {
        $configFinder = new ConfigFinder();
        $file = $configFinder->find($this->getResourcesDir());
        $this->assertSame(
            $this->getResourcesDir() . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'cli-config.php',
            $file
        );
    }

    public function testFindWrong()
    {
        $configFinder = new ConfigFinder();
        $file = $configFinder->find(__DIR__);
        $this->assertSame(
            '',
            $file
        );
    }

    private function getResourcesDir()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'resources';
    }
}
