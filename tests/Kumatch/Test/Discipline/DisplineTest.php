<?php

namespace Kumatch\Test\Discipline;

use Kumatch\Discipline\Discipline;

class DisciplineTest extends \PHPUnit_Framework_TestCase
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
        $this->assertInstanceOf('\Kumatch\Discipline\Discipline', Discipline::start(42));
    }

    public function testIsIntByStrictMode()
    {
        $this->assertTrue(Discipline::start(42)->isInt()->isPass());
        $this->assertTrue(Discipline::start(-42)->isInt()->isPass());
        $this->assertTrue(Discipline::start(0)->isInt()->isPass());
        $this->assertTrue(Discipline::start(0xA)->isInt()->isPass());

        $this->assertFalse(Discipline::start('42')->isInt()->isPass());
        $this->assertFalse(Discipline::start('-42')->isInt()->isPass());
        $this->assertFalse(Discipline::start('0')->isInt()->isPass());
        $this->assertFalse(Discipline::start((float)42)->isInt()->isPass());

        $this->assertFalse(Discipline::start('A')->isInt()->isPass());
        $this->assertFalse(Discipline::start('0xA')->isInt()->isPass());
        $this->assertFalse(Discipline::start(true)->isInt()->isPass());
        $this->assertFalse(Discipline::start(null)->isInt()->isPass());
        $this->assertFalse(Discipline::start('')->isInt()->isPass());
        $this->assertFalse(Discipline::start(array(1))->isInt()->isPass());
        $this->assertFalse(Discipline::start(4.2)->isInt()->isPass());
        $this->assertFalse(Discipline::start(-4.2)->isInt()->isPass());
    }

    public function testIsIntNotStrictMode()
    {
        $this->assertTrue(Discipline::start(42)->isInt(false)->isPass());
        $this->assertTrue(Discipline::start(-42)->isInt(false)->isPass());
        $this->assertTrue(Discipline::start(0)->isInt(false)->isPass());
        $this->assertTrue(Discipline::start(0xA)->isInt(false)->isPass());

        $this->assertTrue(Discipline::start('42')->isInt(false)->isPass());
        $this->assertTrue(Discipline::start('-42')->isInt(false)->isPass());
        $this->assertTrue(Discipline::start('0')->isInt(false)->isPass());
        $this->assertTrue(Discipline::start((float)42)->isInt(false)->isPass());

        $this->assertFalse(Discipline::start('A')->isInt(false)->isPass());
        $this->assertFalse(Discipline::start('0xA')->isInt(false)->isPass());
        $this->assertFalse(Discipline::start(true)->isInt(false)->isPass());
        $this->assertFalse(Discipline::start(null)->isInt(false)->isPass());
        $this->assertFalse(Discipline::start('')->isInt(false)->isPass());
        $this->assertFalse(Discipline::start(array(1))->isInt(false)->isPass());
        $this->assertFalse(Discipline::start(4.2)->isInt(false)->isPass());
        $this->assertFalse(Discipline::start(-4.2)->isInt(false)->isPass());
    }

    public function testIsAlpha()
    {
        $this->assertTrue(Discipline::start('OK')->isAlpha()->isPass());
        $this->assertTrue(Discipline::start('pass')->isAlpha()->isPass());
        $this->assertTrue(Discipline::start('Fail')->isAlpha()->isPass());

        $this->assertFalse(Discipline::start('Its OK')->isAlpha()->isPass());
        $this->assertFalse(Discipline::start('nopass1')->isAlpha()->isPass());
        $this->assertFalse(Discipline::start('33-4')->isAlpha()->isPass());
        $this->assertFalse(Discipline::start(42)->isAlpha()->isPass());
        $this->assertFalse(Discipline::start(true)->isAlpha()->isPass());
        $this->assertFalse(Discipline::start(null)->isAlpha()->isPass());
        $this->assertFalse(Discipline::start('')->isAlpha()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->isAlpha()->isPass());
    }


    public function testIsAlphaNumeric()
    {
        $this->assertTrue(Discipline::start('OK')->isAlphaNumeric()->isPass());
        $this->assertTrue(Discipline::start('pass')->isAlphaNumeric()->isPass());
        $this->assertTrue(Discipline::start('Fail')->isAlphaNumeric()->isPass());
        $this->assertTrue(Discipline::start('123')->isAlphaNumeric()->isPass());
        $this->assertTrue(Discipline::start(42)->isAlphaNumeric()->isPass());
        $this->assertTrue(Discipline::start('success123')->isAlphaNumeric()->isPass());

        $this->assertFalse(Discipline::start('Its OK')->isAlphaNumeric()->isPass());
        $this->assertFalse(Discipline::start('33-4')->isAlphaNumeric()->isPass());
        $this->assertFalse(Discipline::start(true)->isAlphaNumeric()->isPass());
        $this->assertFalse(Discipline::start(null)->isAlphaNumeric()->isPass());
        $this->assertFalse(Discipline::start('')->isAlphaNumeric()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->isAlphaNumeric()->isPass());
    }

    public function testIsNumeric()
    {
        $this->assertTrue(Discipline::start('123')->isNumeric()->isPass());
        $this->assertTrue(Discipline::start(42)->isNumeric()->isPass());
        $this->assertTrue(Discipline::start('-123')->isNumeric()->isPass());
        $this->assertTrue(Discipline::start(-42)->isNumeric()->isPass());

        $this->assertFalse(Discipline::start('OK')->isNumeric()->isPass());
        $this->assertFalse(Discipline::start('pass')->isNumeric()->isPass());
        $this->assertFalse(Discipline::start('Fail')->isNumeric()->isPass());
        $this->assertFalse(Discipline::start('success123')->isNumeric()->isPass());

        $this->assertFalse(Discipline::start('Its OK')->isNumeric()->isPass());
        $this->assertFalse(Discipline::start('33-4')->isNumeric()->isPass());
        $this->assertFalse(Discipline::start(true)->isNumeric()->isPass());
        $this->assertFalse(Discipline::start(null)->isNumeric()->isPass());
        $this->assertFalse(Discipline::start('')->isNumeric()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->isNumeric()->isPass());
    }

    public function testIsLowerCase()
    {
        $this->assertTrue(Discipline::start('123')->isLowerCase()->isPass());
        $this->assertTrue(Discipline::start(42)->isLowerCase()->isPass());
        $this->assertTrue(Discipline::start('-123')->isLowerCase()->isPass());
        $this->assertTrue(Discipline::start(-42)->isLowerCase()->isPass());
        $this->assertTrue(Discipline::start('ok')->isLowerCase()->isPass());
        $this->assertTrue(Discipline::start('success123')->isLowerCase()->isPass());
        $this->assertTrue(Discipline::start('mr.x')->isLowerCase()->isPass());

        $this->assertFalse(Discipline::start('Fail')->isLowerCase()->isPass());
        $this->assertFalse(Discipline::start('OK!')->isLowerCase()->isPass());
        $this->assertFalse(Discipline::start(true)->isLowerCase()->isPass());
        $this->assertFalse(Discipline::start(null)->isLowerCase()->isPass());
        $this->assertFalse(Discipline::start('')->isLowerCase()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->isLowerCase()->isPass());
    }

    public function testIsUpperCase()
    {
        $this->assertTrue(Discipline::start('SUCCESS')->isUpperCase()->isPass());
        $this->assertTrue(Discipline::start('OK!')->isUpperCase()->isPass());
        $this->assertTrue(Discipline::start('123')->isUpperCase()->isPass());
        $this->assertTrue(Discipline::start(42)->isUpperCase()->isPass());
        $this->assertTrue(Discipline::start('-123')->isUpperCase()->isPass());
        $this->assertTrue(Discipline::start(-42)->isUpperCase()->isPass());

        $this->assertFalse(Discipline::start('ok')->isUpperCase()->isPass());
        $this->assertFalse(Discipline::start('success123')->isUpperCase()->isPass());
        $this->assertFalse(Discipline::start('Fail')->isUpperCase()->isPass());
        $this->assertFalse(Discipline::start('mr.x')->isUpperCase()->isPass());
        $this->assertFalse(Discipline::start(true)->isUpperCase()->isPass());
        $this->assertFalse(Discipline::start(null)->isUpperCase()->isPass());
        $this->assertFalse(Discipline::start('')->isUpperCase()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->isUpperCase()->isPass());
    }

    public function testIsDecimal()
    {
        $this->assertTrue(Discipline::start(42)->isDecimal()->isPass());
        $this->assertTrue(Discipline::start(42.123)->isDecimal()->isPass());
        $this->assertTrue(Discipline::start(-42)->isDecimal()->isPass());
        $this->assertTrue(Discipline::start(-42.123)->isDecimal()->isPass());
        $this->assertTrue(Discipline::start(0.42)->isDecimal()->isPass());
        $this->assertTrue(Discipline::start(-0.42)->isDecimal()->isPass());
        $this->assertTrue(Discipline::start(0)->isDecimal()->isPass());
        $this->assertTrue(Discipline::start('42')->isDecimal()->isPass());
        $this->assertTrue(Discipline::start('42.123')->isDecimal()->isPass());
        $this->assertTrue(Discipline::start('0.42')->isDecimal()->isPass());
        $this->assertTrue(Discipline::start('-42')->isDecimal()->isPass());
        $this->assertTrue(Discipline::start('-42.123')->isDecimal()->isPass());
        $this->assertTrue(Discipline::start('-0.42')->isDecimal()->isPass());
        $this->assertTrue(Discipline::start(123456789012345678901234567890)->isDecimal()->isPass());
        $this->assertTrue(Discipline::start('4.2e+19')->isDecimal()->isPass());
        $this->assertTrue(Discipline::start('0.42e-19')->isDecimal()->isPass());
        $this->assertTrue(Discipline::start('-0.42E-19')->isDecimal()->isPass());

        $this->assertFalse(Discipline::start('ok')->isDecimal()->isPass());
        $this->assertFalse(Discipline::start('success123')->isDecimal()->isPass());
        $this->assertFalse(Discipline::start(true)->isDecimal()->isPass());
        $this->assertFalse(Discipline::start(null)->isDecimal()->isPass());
        $this->assertFalse(Discipline::start('')->isDecimal()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->isDecimal()->isPass());
    }

    public function testIsNull()
    {
        $this->assertTrue(Discipline::start(null)->isNull()->isPass());

        $this->assertFalse(Discipline::start('ok')->isNull()->isPass());
        $this->assertFalse(Discipline::start(42)->isNull()->isPass());
        $this->assertFalse(Discipline::start(0)->isNull()->isPass());
        $this->assertFalse(Discipline::start(false)->isNull()->isPass());
        $this->assertFalse(Discipline::start('')->isNull()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->isNull()->isPass());
    }

    public function testNotNull()
    {
        $this->assertTrue(Discipline::start('ok')->notNull()->isPass());
        $this->assertTrue(Discipline::start(42)->notNull()->isPass());
        $this->assertTrue(Discipline::start(0)->notNull()->isPass());
        $this->assertTrue(Discipline::start(false)->notNull()->isPass());
        $this->assertTrue(Discipline::start('')->notNull()->isPass());
        $this->assertTrue(Discipline::start(array('NG'))->notNull()->isPass());

        $this->assertFalse(Discipline::start(null)->notNull()->isPass());
    }


    public function testIsEmpty()
    {
        $this->assertTrue(Discipline::start(null)->isEmpty()->isPass());
        $this->assertTrue(Discipline::start('')->isEmpty()->isPass());

        $this->assertFalse(Discipline::start('ok')->isEmpty()->isPass());
        $this->assertFalse(Discipline::start(42)->isEmpty()->isPass());
        $this->assertFalse(Discipline::start(0)->isEmpty()->isPass());
        $this->assertFalse(Discipline::start(false)->isEmpty()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->isEmpty()->isPass());
    }

    public function testNotEmpty()
    {
        $this->assertTrue(Discipline::start('ok')->notEmpty()->isPass());
        $this->assertTrue(Discipline::start(42)->notEmpty()->isPass());
        $this->assertTrue(Discipline::start(0)->notEmpty()->isPass());
        $this->assertTrue(Discipline::start(false)->notEmpty()->isPass());
        $this->assertTrue(Discipline::start(array('NG'))->notEmpty()->isPass());

        $this->assertFalse(Discipline::start(null)->notEmpty()->isPass());
        $this->assertFalse(Discipline::start('')->notEmpty()->isPass());
    }

}