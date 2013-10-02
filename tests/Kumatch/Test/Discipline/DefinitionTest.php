<?php

namespace Kumatch\Test\Discipline;

use Kumatch\Discipline\Definition;
use Kumatch\Discipline\Discipline;

class DefinitionTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertInstanceOf('\Kumatch\Discipline\Definition', Discipline::define());
    }

    public function testDefineAndCheck()
    {
        $definition = new Definition();
        $definition->int(true)->min(1)->max(10);

        $result = $definition->invoke(1);

        $this->assertInstanceOf('\Kumatch\Discipline\Discipline', $result);

        $this->assertTrue($definition->invoke(1)->isPass());
        $this->assertTrue($definition->invoke(5)->isPass());
        $this->assertTrue($definition->invoke(10)->isPass());

        $this->assertFalse($definition->invoke(0)->isPass());
        $this->assertFalse($definition->invoke(11)->isPass());
        $this->assertFalse($definition->invoke()->isPass());
        $this->assertFalse($definition->invoke("string")->isPass());
        $this->assertFalse($definition->invoke("1")->isPass());
        $this->assertFalse($definition->invoke("10")->isPass());
    }
}