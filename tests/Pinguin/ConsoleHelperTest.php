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

    /**
     * Tests the creation of helperSet
     */
    public function testCreateHelperSet()
    {
        $consoleHelper = new ConsoleHelper();
        $result = $consoleHelper->createHelperSet($this->getEntityManager());

        $this->assertInstanceOf('\Symfony\Component\Console\Helper\HelperSet', $result);
        $this->assertInstanceOf('\Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper', $result->get('db'));
        $this->assertInstanceOf('\Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper', $result->get('em'));
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    private function getEntityManager()
    {
        $mock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->any())
            ->method('getConnection')
            ->will($this->returnValue($this->getConnection()));
        return $mock;
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    private function getConnection()
    {
        return $this->getMockBuilder('Doctrine\DBAL\Connection')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
