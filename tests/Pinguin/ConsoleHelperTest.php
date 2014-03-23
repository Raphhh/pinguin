<?php
namespace Pinguin;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Class ConsoleHelperTest
 * @package Pinguin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ConsoleHelperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test the creation of a console
     */
    public function testCreateConsole()
    {
        $helperSet = new HelperSet();
        $command = new Command('test');
        $commands = array($command);

        $consoleHelper = new ConsoleHelper();
        $result = $consoleHelper->createConsole($helperSet, $commands);

        $this->assertInstanceOf('\Symfony\Component\Console\Application', $result);
        $this->assertSame('Pinguin Command Line Interface', $result->getName());
        $this->assertSame('1', $result->getVersion());
        $this->assertSame($helperSet, $result->getHelperSet());
        $this->assertSame($command, $result->get('test'));
    }
}
