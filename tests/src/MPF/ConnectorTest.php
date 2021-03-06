<?php

namespace Test\MPF;

use MPF\Connector;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-09-02 at 03:00:12.
 */
class ConnectorTest extends \Test\AbraFlexi\AbraFlexiRWTest
{
    /**
     * @var Connector
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new Connector();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {

    }

    /**
     * @covers MPF\Connector::parseCmdline
     */
    public function testParseCmdline()
    {
        Connector::parseCmdline();
        $this->assertTrue(true);
    }

    /**
     * @covers MPF\Connector::returnExitCode
     */
    public function testReturnExitCode()
    {
        $this->assertTrue(true);
    }
}
