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

    public function testIsIntStrictMode()
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

    public function testIsFloatStrictMode()
    {
        $this->assertTrue(Discipline::start(42.123)->isFloat()->isPass());
        $this->assertTrue(Discipline::start(-42.123)->isFloat()->isPass());
        $this->assertTrue(Discipline::start(0.42)->isFloat()->isPass());
        $this->assertTrue(Discipline::start(-0.42)->isFloat()->isPass());
        $this->assertTrue(Discipline::start((float)42)->isFloat()->isPass());
        $this->assertTrue(Discipline::start((float)-42)->isFloat()->isPass());
        $this->assertTrue(Discipline::start((float)0)->isFloat()->isPass());
        $this->assertTrue(Discipline::start(123456789012345678901234567890)->isFloat()->isPass());

        $this->assertFalse(Discipline::start(42)->isFloat()->isPass());
        $this->assertFalse(Discipline::start(-42)->isFloat()->isPass());
        $this->assertFalse(Discipline::start(0)->isFloat()->isPass());

        $this->assertFalse(Discipline::start('42')->isFloat()->isPass());
        $this->assertFalse(Discipline::start('42.123')->isFloat()->isPass());
        $this->assertFalse(Discipline::start('0.42')->isFloat()->isPass());
        $this->assertFalse(Discipline::start('-42')->isFloat()->isPass());
        $this->assertFalse(Discipline::start('-42.123')->isFloat()->isPass());
        $this->assertFalse(Discipline::start('-0.42')->isFloat()->isPass());
        $this->assertFalse(Discipline::start('4.2e+19')->isFloat()->isPass());
        $this->assertFalse(Discipline::start('0.42e-19')->isFloat()->isPass());
        $this->assertFalse(Discipline::start('-0.42E-19')->isFloat()->isPass());

        $this->assertFalse(Discipline::start('ok')->isFloat()->isPass());
        $this->assertFalse(Discipline::start('success123')->isFloat()->isPass());
        $this->assertFalse(Discipline::start(true)->isFloat()->isPass());
        $this->assertFalse(Discipline::start(null)->isFloat()->isPass());
        $this->assertFalse(Discipline::start('')->isFloat()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->isFloat()->isPass());
    }

    public function testIsFloatNotStrictMode()
    {
        $this->assertTrue(Discipline::start(42.123)->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start(-42.123)->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start(0.42)->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start(-0.42)->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start((float)42)->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start((float)-42)->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start((float)0)->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start(123456789012345678901234567890)->isFloat(false)->isPass());

        $this->assertTrue(Discipline::start(42)->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start(-42)->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start(0)->isFloat(false)->isPass());

        $this->assertTrue(Discipline::start('42')->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start('42.123')->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start('0.42')->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start('-42')->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start('-42.123')->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start('-0.42')->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start('4.2e+19')->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start('0.42e-19')->isFloat(false)->isPass());
        $this->assertTrue(Discipline::start('-0.42E-19')->isFloat(false)->isPass());

        $this->assertFalse(Discipline::start('ok')->isFloat(false)->isPass());
        $this->assertFalse(Discipline::start('success123')->isFloat(false)->isPass());
        $this->assertFalse(Discipline::start(true)->isFloat(false)->isPass());
        $this->assertFalse(Discipline::start(null)->isFloat(false)->isPass());
        $this->assertFalse(Discipline::start('')->isFloat(false)->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->isFloat(false)->isPass());
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

    public function testEquals()
    {
        $this->assertTrue(Discipline::start(null)->equals(null)->isPass());
        $this->assertFalse(Discipline::start(null)->equals('')->isPass());
        $this->assertFalse(Discipline::start(null)->equals('null')->isPass());
        $this->assertTrue(Discipline::start('')->equals('')->isPass());
        $this->assertFalse(Discipline::start('')->equals(null)->isPass());

        $this->assertTrue(Discipline::start(false)->equals(false)->isPass());
        $this->assertFalse(Discipline::start(false)->equals(true)->isPass());
        $this->assertFalse(Discipline::start(false)->equals(null)->isPass());
        $this->assertFalse(Discipline::start(false)->equals('false')->isPass());

        $this->assertTrue(Discipline::start(42)->equals(42)->isPass());
        $this->assertFalse(Discipline::start(42)->equals('42')->isPass());
        $this->assertTrue(Discipline::start('42')->equals('42')->isPass());
        $this->assertFalse(Discipline::start('42')->equals(42)->isPass());

        $obj1 = array(1, 3, 5);
        $obj2 = array('1', '3', '5');
        $obj3 = array(1, 5, 3);
        $this->assertTrue(Discipline::start($obj1)->equals($obj1)->isPass());
        $this->assertTrue(Discipline::start($obj2)->equals($obj2)->isPass());
        $this->assertTrue(Discipline::start($obj3)->equals($obj3)->isPass());
        $this->assertFalse(Discipline::start($obj1)->equals($obj2)->isPass());
        $this->assertFalse(Discipline::start($obj1)->equals($obj3)->isPass());

        $obj0 = new \StdClass();
        $obj1 = new \StdClass();
        $obj2 = new \StdClass();
        $obj3 = new \StdClass();
        $obj4 = new \StdClass();

        $obj0->foo = 1;
        $obj0->bar = 3;
        $obj0->baz = 5;

        $obj1->foo = 1;
        $obj1->bar = 3;
        $obj1->baz = 5;

        $obj2->foo = '1';
        $obj2->bar = '3';
        $obj2->baz = '5';

        $obj3->foo = 1;
        $obj3->baz = 5;
        $obj3->bar = 3;

        $obj4->foo = 1;
        $obj4->bar = 3;
        $obj4->baz = 5;
        $obj4->qux = 7;

        $this->assertTrue(Discipline::start($obj1)->equals($obj1)->isPass());
        $this->assertTrue(Discipline::start($obj2)->equals($obj2)->isPass());
        $this->assertTrue(Discipline::start($obj3)->equals($obj3)->isPass());
        $this->assertTrue(Discipline::start($obj4)->equals($obj4)->isPass());
        $this->assertTrue(Discipline::start($obj1)->equals($obj0)->isPass());
        $this->assertFalse(Discipline::start($obj1)->equals($obj2)->isPass());
        $this->assertFalse(Discipline::start($obj1)->equals($obj3)->isPass());
        $this->assertFalse(Discipline::start($obj1)->equals($obj4)->isPass());
    }

    public function testContains()
    {
        $this->assertTrue(Discipline::start("abcdef")->contains("abcdef")->isPass());
        $this->assertTrue(Discipline::start("abcdef")->contains("ab")->isPass());
        $this->assertTrue(Discipline::start("abcdef")->contains("cd")->isPass());
        $this->assertTrue(Discipline::start("abcdef")->contains("ef")->isPass());

        $this->assertFalse(Discipline::start("abcdef")->contains("aa")->isPass());
        $this->assertFalse(Discipline::start("abcdef")->contains("abcdefg")->isPass());

        $this->assertTrue(Discipline::start("abcdef")->contains("")->isPass());
    }

    public function testNotContains()
    {
        $this->assertTrue(Discipline::start("abcdef")->notContains("x")->isPass());
        $this->assertTrue(Discipline::start("abcdef")->notContains("aa")->isPass());
        $this->assertTrue(Discipline::start("abcdef")->notContains("abcdefg")->isPass());

        $this->assertFalse(Discipline::start("abcdef")->notContains("abcdef")->isPass());
        $this->assertFalse(Discipline::start("abcdef")->notContains("ab")->isPass());
        $this->assertFalse(Discipline::start("abcdef")->notContains("cd")->isPass());
        $this->assertFalse(Discipline::start("abcdef")->notContains("ef")->isPass());

        $this->assertFalse(Discipline::start("abcdef")->notContains("")->isPass());
    }

    public function testMatch()
    {
        $this->assertTrue(Discipline::start("ABCDEF")->match("/^ABC/")->isPass());
        $this->assertTrue(Discipline::start("ABCDEF")->match("/ABCDEF/")->isPass());
        $this->assertTrue(Discipline::start("ABCDEF")->match("/cd/i")->isPass());
        $this->assertTrue(Discipline::start(1234567890)->match("/890$/")->isPass());

        $this->assertFalse(Discipline::start("ABCDEF")->match("/X/")->isPass());
        $this->assertFalse(Discipline::start("ABCDEF")->match("/abc/")->isPass());
        $this->assertFalse(Discipline::start("ABCDEF")->match("/FG/")->isPass());
    }

    public function testNotMatch()
    {
        $this->assertFalse(Discipline::start("ABCDEF")->notMatch("/^ABC/")->isPass());
        $this->assertFalse(Discipline::start("ABCDEF")->notMatch("/ABCDEF/")->isPass());
        $this->assertFalse(Discipline::start("ABCDEF")->notMatch("/cd/i")->isPass());
        $this->assertFalse(Discipline::start(1234567890)->notMatch("/890$/")->isPass());

        $this->assertTrue(Discipline::start("ABCDEF")->notMatch("/X/")->isPass());
        $this->assertTrue(Discipline::start("ABCDEF")->notMatch("/abc/")->isPass());
        $this->assertTrue(Discipline::start("ABCDEF")->notMatch("/FG/")->isPass());
    }

    public function testLength()
    {
        $this->assertTrue(Discipline::start("abcdef")->length(0, 10)->isPass());
        $this->assertFalse(Discipline::start("abcdef")->length(7, 10)->isPass());
        $this->assertFalse(Discipline::start("abcdef")->length(0, 5)->isPass());

        $this->assertTrue(Discipline::start("abcdef")->length(6)->isPass());
        $this->assertFalse(Discipline::start("abcdef")->length(7)->isPass());
    }

    public function testMin()
    {
        $this->assertTrue(Discipline::start(42)->min(0)->isPass());
        $this->assertTrue(Discipline::start(42)->min("0")->isPass());
        $this->assertTrue(Discipline::start(42)->min(42)->isPass());
        $this->assertTrue(Discipline::start(42)->min("42")->isPass());
        $this->assertFalse(Discipline::start(42)->min(43)->isPass());
        $this->assertFalse(Discipline::start(42)->min("43")->isPass());

        $this->assertTrue(Discipline::start("42")->min(0)->isPass());
        $this->assertTrue(Discipline::start("42")->min("0")->isPass());
        $this->assertTrue(Discipline::start("42")->min(42)->isPass());
        $this->assertTrue(Discipline::start("42")->min("42")->isPass());
        $this->assertFalse(Discipline::start("42")->min(43)->isPass());
        $this->assertFalse(Discipline::start("42")->min("43")->isPass());

        $this->assertTrue(Discipline::start(4.2)->min(4)->isPass());
        $this->assertTrue(Discipline::start(4.2)->min(4.2)->isPass());
        $this->assertFalse(Discipline::start(4.2)->min(4.201)->isPass());

        $this->assertFalse(Discipline::start("A")->min(0)->isPass());
        $this->assertFalse(Discipline::start(null)->min(0)->isPass());
        $this->assertFalse(Discipline::start("")->min(0)->isPass());
        $this->assertFalse(Discipline::start(true)->min(0)->isPass());
    }

    public function testMax()
    {
        $this->assertTrue(Discipline::start(42)->max(100)->isPass());
        $this->assertTrue(Discipline::start(42)->max("100")->isPass());
        $this->assertTrue(Discipline::start(42)->max(42)->isPass());
        $this->assertTrue(Discipline::start(42)->max("42")->isPass());
        $this->assertFalse(Discipline::start(42)->max(41)->isPass());
        $this->assertFalse(Discipline::start(42)->max("41")->isPass());

        $this->assertTrue(Discipline::start("42")->max(100)->isPass());
        $this->assertTrue(Discipline::start("42")->max("100")->isPass());
        $this->assertTrue(Discipline::start("42")->max(42)->isPass());
        $this->assertTrue(Discipline::start("42")->max("42")->isPass());
        $this->assertFalse(Discipline::start("42")->max(41)->isPass());
        $this->assertFalse(Discipline::start("42")->max("41")->isPass());

        $this->assertTrue(Discipline::start(4.2)->max(5)->isPass());
        $this->assertTrue(Discipline::start(4.2)->max(4.2)->isPass());
        $this->assertFalse(Discipline::start(4.2)->max(4.19999)->isPass());

        $this->assertFalse(Discipline::start("A")->max(0)->isPass());
        $this->assertFalse(Discipline::start(null)->max(0)->isPass());
        $this->assertFalse(Discipline::start("")->max(0)->isPass());
        $this->assertFalse(Discipline::start(true)->max(0)->isPass());
    }

    public function testIsEmail()
    {
        $this->assertTrue(Discipline::start("foo@example.com")->isEmail()->isPass());
        $this->assertTrue(Discipline::start("foo.bar@mail.example.com")->isEmail()->isPass());
        $this->assertTrue(Discipline::start("foo+bar@mail.example.com")->isEmail()->isPass());

        $this->assertFalse(Discipline::start("mail.example.com")->isEmail()->isPass());
        $this->assertFalse(Discipline::start("foo@")->isEmail()->isPass());
        $this->assertFalse(Discipline::start("foo@example")->isEmail()->isPass());

        $this->assertFalse(Discipline::start("foo..bar@example.com")->isEmail()->isPass());
        $this->assertFalse(Discipline::start("foo.bar.@example.com")->isEmail()->isPass());
        $this->assertFalse(Discipline::start(".foo.bar@example.com")->isEmail()->isPass());
    }

    public function testIsUrl()
    {
        $this->assertTrue(Discipline::start("http://example.com")->isUrl()->isPass());
        $this->assertTrue(Discipline::start("https://example.com/")->isUrl()->isPass());
        $this->assertTrue(Discipline::start("http://example.com/path/to")->isUrl()->isPass());
        $this->assertTrue(Discipline::start("http://example.com:8080")->isUrl()->isPass());
        $this->assertTrue(Discipline::start("http://user:pass@example.com")->isUrl()->isPass());
        $this->assertTrue(Discipline::start("http://localhost")->isUrl()->isPass());
        $this->assertTrue(Discipline::start("http://192.168.0.1/")->isUrl()->isPass());
        $this->assertTrue(Discipline::start("http://10.0.0.0/")->isUrl()->isPass());
        $this->assertTrue(Discipline::start("ftp://example.com")->isUrl()->isPass());
        $this->assertTrue(Discipline::start("mailto:foo@example.com")->isUrl()->isPass());
        $this->assertTrue(Discipline::start("http://example.com?q=%2F&page=1")->isUrl()->isPass());
        $this->assertTrue(Discipline::start("http://example.com/path/to$-_.+!*'(),")->isUrl()->isPass());

        $this->assertFalse(Discipline::start("example.com")->isUrl()->isPass());
        $this->assertFalse(Discipline::start("http://example.")->isUrl()->isPass());
        $this->assertFalse(Discipline::start("http//example.com")->isUrl()->isPass());
        $this->assertFalse(Discipline::start("http:/example.com")->isUrl()->isPass());
        $this->assertFalse(Discipline::start("http:example.com")->isUrl()->isPass());
        $this->assertFalse(Discipline::start("http://.com")->isUrl()->isPass());
    }

    public function testIsIPv4()
    {
        $this->assertTrue(Discipline::start("127.0.0.1")->isIPv4()->isPass());
        $this->assertTrue(Discipline::start("1.2.3.4")->isIPv4()->isPass());
        $this->assertTrue(Discipline::start("0.0.0.0")->isIPv4()->isPass());
        $this->assertTrue(Discipline::start("255.255.255.255")->isIPv4()->isPass());

        $this->assertFalse(Discipline::start("1.2.3.4.5")->isIPv4()->isPass());
        $this->assertFalse(Discipline::start("1.2.3.a")->isIPv4()->isPass());
        $this->assertFalse(Discipline::start("256.0.0.0")->isIPv4()->isPass());
        $this->assertFalse(Discipline::start("0.256.0.0")->isIPv4()->isPass());
        $this->assertFalse(Discipline::start("0.0.256.0")->isIPv4()->isPass());
        $this->assertFalse(Discipline::start("0.0.0.256")->isIPv4()->isPass());

        $this->assertFalse(Discipline::start("::")->isIPv4()->isPass());
        $this->assertFalse(Discipline::start("::1")->isIPv4()->isPass());

        $this->assertFalse(Discipline::start("2001:db8:bd05:1d2:288a:1fc0:1:10ee")->isIPv4()->isPass());
        $this->assertFalse(Discipline::start("ffff:ffff:ffff:ffff:ffff:ffff:ffff:ffff")->isIPv4()->isPass());
        $this->assertFalse(Discipline::start("2001:db8::1234:0:0:9abc")->isIPv4()->isPass());
        $this->assertFalse(Discipline::start("2001:db8::9abc")->isIPv4()->isPass());
    }

    public function testIsIPv6()
    {
        $this->assertTrue(Discipline::start("::")->isIPv6()->isPass());
        $this->assertTrue(Discipline::start("::f")->isIPv6()->isPass());

        $this->assertTrue(Discipline::start("2001:db8:bd05:1d2:288a:1fc0:1:10ee")->isIPv6()->isPass());
        $this->assertTrue(Discipline::start("ffff:ffff:ffff:ffff:ffff:ffff:ffff:ffff")->isIPv6()->isPass());
        $this->assertTrue(Discipline::start("2001:db8::1234:0:0:9abc")->isIPv6()->isPass());
        $this->assertTrue(Discipline::start("2001:db8::9abc")->isIPv6()->isPass());

        $this->assertFalse(Discipline::start("::g")->isIPv6()->isPass());
        $this->assertFalse(Discipline::start("1234:5::xyz")->isIPv6()->isPass());

        $this->assertFalse(Discipline::start("127.0.0.1")->isIPv6()->isPass());
    }


    public function testIsIP()
    {
        $this->assertTrue(Discipline::start("127.0.0.1")->isIP()->isPass());
        $this->assertTrue(Discipline::start("1.2.3.4")->isIP()->isPass());
        $this->assertTrue(Discipline::start("0.0.0.0")->isIP()->isPass());
        $this->assertTrue(Discipline::start("255.255.255.255")->isIP()->isPass());

        $this->assertTrue(Discipline::start("::")->isIP()->isPass());
        $this->assertTrue(Discipline::start("::1")->isIP()->isPass());
        $this->assertTrue(Discipline::start("2001:db8:bd05:1d2:288a:1fc0:1:10ee")->isIP()->isPass());
        $this->assertTrue(Discipline::start("ffff:ffff:ffff:ffff:ffff:ffff:ffff:ffff")->isIP()->isPass());
        $this->assertTrue(Discipline::start("2001:db8::1234:0:0:9abc")->isIP()->isPass());
        $this->assertTrue(Discipline::start("2001:db8::9abc")->isIP()->isPass());

        $this->assertFalse(Discipline::start("1.2.3.4.5")->isIP()->isPass());
        $this->assertFalse(Discipline::start("1.2.3.a")->isIP()->isPass());
        $this->assertFalse(Discipline::start("256.0.0.0")->isIP()->isPass());
        $this->assertFalse(Discipline::start("0.256.0.0")->isIP()->isPass());
        $this->assertFalse(Discipline::start("0.0.256.0")->isIP()->isPass());
        $this->assertFalse(Discipline::start("0.0.0.256")->isIP()->isPass());

        $this->assertFalse(Discipline::start("::g")->isIP()->isPass());
        $this->assertFalse(Discipline::start("1234:5::xyz")->isIP()->isPass());
    }
}