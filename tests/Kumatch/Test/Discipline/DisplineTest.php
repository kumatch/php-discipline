<?php

namespace Kumatch\Test\Discipline;

use Kumatch\Discipline\Discipline;

class DisciplineTestRunChecker
{
    public function invoke($value)
    {
        if (!is_numeric($value) || $value < 0 || $value > 10) {
            return false;
        } else {
            return true;
        }
    }
}

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
        $this->assertTrue(Discipline::start(42)->int()->isPass());
        $this->assertTrue(Discipline::start(-42)->int()->isPass());
        $this->assertTrue(Discipline::start(0)->int()->isPass());
        $this->assertTrue(Discipline::start(0xA)->int()->isPass());

        $this->assertFalse(Discipline::start('42')->int()->isPass());
        $this->assertFalse(Discipline::start('-42')->int()->isPass());
        $this->assertFalse(Discipline::start('0')->int()->isPass());
        $this->assertFalse(Discipline::start((float)42)->int()->isPass());

        $this->assertFalse(Discipline::start('A')->int()->isPass());
        $this->assertFalse(Discipline::start('0xA')->int()->isPass());
        $this->assertFalse(Discipline::start('日本語')->int()->isPass());
        $this->assertFalse(Discipline::start(true)->int()->isPass());
        $this->assertFalse(Discipline::start(null)->int()->isPass());
        $this->assertFalse(Discipline::start('')->int()->isPass());
        $this->assertFalse(Discipline::start(array(1))->int()->isPass());
        $this->assertFalse(Discipline::start(4.2)->int()->isPass());
        $this->assertFalse(Discipline::start(-4.2)->int()->isPass());
    }

    public function testIsIntNotStrictMode()
    {
        $this->assertTrue(Discipline::start(42)->int(false)->isPass());
        $this->assertTrue(Discipline::start(-42)->int(false)->isPass());
        $this->assertTrue(Discipline::start(0)->int(false)->isPass());
        $this->assertTrue(Discipline::start(0xA)->int(false)->isPass());

        $this->assertTrue(Discipline::start('42')->int(false)->isPass());
        $this->assertTrue(Discipline::start('-42')->int(false)->isPass());
        $this->assertTrue(Discipline::start('0')->int(false)->isPass());
        $this->assertTrue(Discipline::start((float)42)->int(false)->isPass());

        $this->assertFalse(Discipline::start('A')->int(false)->isPass());
        $this->assertFalse(Discipline::start('0xA')->int(false)->isPass());
        $this->assertFalse(Discipline::start('日本語')->int(false)->isPass());
        $this->assertFalse(Discipline::start(true)->int(false)->isPass());
        $this->assertFalse(Discipline::start(null)->int(false)->isPass());
        $this->assertFalse(Discipline::start('')->int(false)->isPass());
        $this->assertFalse(Discipline::start(array(1))->int(false)->isPass());
        $this->assertFalse(Discipline::start(4.2)->int(false)->isPass());
        $this->assertFalse(Discipline::start(-4.2)->int(false)->isPass());
    }

    public function testIsFloatStrictMode()
    {
        $this->assertTrue(Discipline::start(42.123)->float()->isPass());
        $this->assertTrue(Discipline::start(-42.123)->float()->isPass());
        $this->assertTrue(Discipline::start(0.42)->float()->isPass());
        $this->assertTrue(Discipline::start(-0.42)->float()->isPass());
        $this->assertTrue(Discipline::start((float)42)->float()->isPass());
        $this->assertTrue(Discipline::start((float)-42)->float()->isPass());
        $this->assertTrue(Discipline::start((float)0)->float()->isPass());
        $this->assertTrue(Discipline::start(123456789012345678901234567890)->float()->isPass());

        $this->assertFalse(Discipline::start(42)->float()->isPass());
        $this->assertFalse(Discipline::start(-42)->float()->isPass());
        $this->assertFalse(Discipline::start(0)->float()->isPass());

        $this->assertFalse(Discipline::start('42')->float()->isPass());
        $this->assertFalse(Discipline::start('42.123')->float()->isPass());
        $this->assertFalse(Discipline::start('0.42')->float()->isPass());
        $this->assertFalse(Discipline::start('-42')->float()->isPass());
        $this->assertFalse(Discipline::start('-42.123')->float()->isPass());
        $this->assertFalse(Discipline::start('-0.42')->float()->isPass());
        $this->assertFalse(Discipline::start('4.2e+19')->float()->isPass());
        $this->assertFalse(Discipline::start('0.42e-19')->float()->isPass());
        $this->assertFalse(Discipline::start('-0.42E-19')->float()->isPass());

        $this->assertFalse(Discipline::start('ok')->float()->isPass());
        $this->assertFalse(Discipline::start('success123')->float()->isPass());
        $this->assertFalse(Discipline::start('日本語')->float()->isPass());
        $this->assertFalse(Discipline::start(true)->float()->isPass());
        $this->assertFalse(Discipline::start(null)->float()->isPass());
        $this->assertFalse(Discipline::start('')->float()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->float()->isPass());
    }

    public function testIsFloatNotStrictMode()
    {
        $this->assertTrue(Discipline::start(42.123)->float(false)->isPass());
        $this->assertTrue(Discipline::start(-42.123)->float(false)->isPass());
        $this->assertTrue(Discipline::start(0.42)->float(false)->isPass());
        $this->assertTrue(Discipline::start(-0.42)->float(false)->isPass());
        $this->assertTrue(Discipline::start((float)42)->float(false)->isPass());
        $this->assertTrue(Discipline::start((float)-42)->float(false)->isPass());
        $this->assertTrue(Discipline::start((float)0)->float(false)->isPass());
        $this->assertTrue(Discipline::start(123456789012345678901234567890)->float(false)->isPass());

        $this->assertTrue(Discipline::start(42)->float(false)->isPass());
        $this->assertTrue(Discipline::start(-42)->float(false)->isPass());
        $this->assertTrue(Discipline::start(0)->float(false)->isPass());

        $this->assertTrue(Discipline::start('42')->float(false)->isPass());
        $this->assertTrue(Discipline::start('42.123')->float(false)->isPass());
        $this->assertTrue(Discipline::start('0.42')->float(false)->isPass());
        $this->assertTrue(Discipline::start('-42')->float(false)->isPass());
        $this->assertTrue(Discipline::start('-42.123')->float(false)->isPass());
        $this->assertTrue(Discipline::start('-0.42')->float(false)->isPass());
        $this->assertTrue(Discipline::start('4.2e+19')->float(false)->isPass());
        $this->assertTrue(Discipline::start('0.42e-19')->float(false)->isPass());
        $this->assertTrue(Discipline::start('-0.42E-19')->float(false)->isPass());

        $this->assertFalse(Discipline::start('ok')->float(false)->isPass());
        $this->assertFalse(Discipline::start('success123')->float(false)->isPass());
        $this->assertFalse(Discipline::start('日本語')->float(false)->isPass());
        $this->assertFalse(Discipline::start(true)->float(false)->isPass());
        $this->assertFalse(Discipline::start(null)->float(false)->isPass());
        $this->assertFalse(Discipline::start('')->float(false)->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->float(false)->isPass());
    }

    public function testAlpha()
    {
        $this->assertTrue(Discipline::start('OK')->alpha()->isPass());
        $this->assertTrue(Discipline::start('pass')->alpha()->isPass());
        $this->assertTrue(Discipline::start('Fail')->alpha()->isPass());

        $this->assertFalse(Discipline::start('Its OK')->alpha()->isPass());
        $this->assertFalse(Discipline::start('nopass1')->alpha()->isPass());
        $this->assertFalse(Discipline::start('33-4')->alpha()->isPass());
        $this->assertFalse(Discipline::start('日本語')->alpha()->isPass());
        $this->assertFalse(Discipline::start(42)->alpha()->isPass());
        $this->assertFalse(Discipline::start(true)->alpha()->isPass());
        $this->assertFalse(Discipline::start(null)->alpha()->isPass());
        $this->assertFalse(Discipline::start('')->alpha()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->alpha()->isPass());
    }


    public function testAlphaNumeric()
    {
        $this->assertTrue(Discipline::start('OK')->alphaNumeric()->isPass());
        $this->assertTrue(Discipline::start('pass')->alphaNumeric()->isPass());
        $this->assertTrue(Discipline::start('Fail')->alphaNumeric()->isPass());
        $this->assertTrue(Discipline::start('123')->alphaNumeric()->isPass());
        $this->assertTrue(Discipline::start(42)->alphaNumeric()->isPass());
        $this->assertTrue(Discipline::start('success123')->alphaNumeric()->isPass());

        $this->assertFalse(Discipline::start('Its OK')->alphaNumeric()->isPass());
        $this->assertFalse(Discipline::start('33-4')->alphaNumeric()->isPass());
        $this->assertFalse(Discipline::start('日本語')->alphaNumeric()->isPass());
        $this->assertFalse(Discipline::start(true)->alphaNumeric()->isPass());
        $this->assertFalse(Discipline::start(null)->alphaNumeric()->isPass());
        $this->assertFalse(Discipline::start('')->alphaNumeric()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->alphaNumeric()->isPass());
    }

    public function testNumeric()
    {
        $this->assertTrue(Discipline::start('123')->numeric()->isPass());
        $this->assertTrue(Discipline::start(42)->numeric()->isPass());
        $this->assertTrue(Discipline::start('-123')->numeric()->isPass());
        $this->assertTrue(Discipline::start(-42)->numeric()->isPass());

        $this->assertFalse(Discipline::start('OK')->numeric()->isPass());
        $this->assertFalse(Discipline::start('pass')->numeric()->isPass());
        $this->assertFalse(Discipline::start('Fail')->numeric()->isPass());
        $this->assertFalse(Discipline::start('success123')->numeric()->isPass());

        $this->assertFalse(Discipline::start('Its OK')->numeric()->isPass());
        $this->assertFalse(Discipline::start('33-4')->numeric()->isPass());
        $this->assertFalse(Discipline::start('日本語')->numeric()->isPass());
        $this->assertFalse(Discipline::start(true)->numeric()->isPass());
        $this->assertFalse(Discipline::start(null)->numeric()->isPass());
        $this->assertFalse(Discipline::start('')->numeric()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->numeric()->isPass());
    }

    public function testAscii()
    {
        $this->assertTrue(Discipline::start('123')->ascii()->isPass());
        $this->assertTrue(Discipline::start(42)->ascii()->isPass());
        $this->assertTrue(Discipline::start('-123')->ascii()->isPass());
        $this->assertTrue(Discipline::start(-42)->ascii()->isPass());

        $this->assertTrue(Discipline::start('OK')->ascii()->isPass());
        $this->assertTrue(Discipline::start('pass')->ascii()->isPass());
        $this->assertTrue(Discipline::start('Fail')->ascii()->isPass());
        $this->assertTrue(Discipline::start('success123')->ascii()->isPass());

        $this->assertTrue(Discipline::start('33-4')->ascii()->isPass());
        $this->assertTrue(Discipline::start('Go!')->ascii()->isPass());
        $this->assertTrue(Discipline::start('@kumatch')->ascii()->isPass());
        $this->assertTrue(Discipline::start('"password":"!#$%&\'\"()-=^|~/_<>,."[]{}')->ascii()->isPass());

        $this->assertFalse(Discipline::start('Its OK')->ascii()->isPass());
        $this->assertFalse(Discipline::start('日本語')->ascii()->isPass());
        $this->assertFalse(Discipline::start(true)->ascii()->isPass());
        $this->assertFalse(Discipline::start(null)->ascii()->isPass());
        $this->assertFalse(Discipline::start('')->ascii()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->ascii()->isPass());
    }

    public function testLowerCase()
    {
        $this->assertTrue(Discipline::start('123')->lowerCase()->isPass());
        $this->assertTrue(Discipline::start(42)->lowerCase()->isPass());
        $this->assertTrue(Discipline::start('-123')->lowerCase()->isPass());
        $this->assertTrue(Discipline::start(-42)->lowerCase()->isPass());
        $this->assertTrue(Discipline::start('ok')->lowerCase()->isPass());
        $this->assertTrue(Discipline::start('success123')->lowerCase()->isPass());
        $this->assertTrue(Discipline::start('mr.x')->lowerCase()->isPass());

        $this->assertFalse(Discipline::start('Fail')->lowerCase()->isPass());
        $this->assertFalse(Discipline::start('OK!')->lowerCase()->isPass());
        $this->assertFalse(Discipline::start(true)->lowerCase()->isPass());
        $this->assertFalse(Discipline::start(null)->lowerCase()->isPass());
        $this->assertFalse(Discipline::start('')->lowerCase()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->lowerCase()->isPass());
    }

    public function testUpperCase()
    {
        $this->assertTrue(Discipline::start('SUCCESS')->upperCase()->isPass());
        $this->assertTrue(Discipline::start('OK!')->upperCase()->isPass());
        $this->assertTrue(Discipline::start('123')->upperCase()->isPass());
        $this->assertTrue(Discipline::start(42)->upperCase()->isPass());
        $this->assertTrue(Discipline::start('-123')->upperCase()->isPass());
        $this->assertTrue(Discipline::start(-42)->upperCase()->isPass());

        $this->assertFalse(Discipline::start('ok')->upperCase()->isPass());
        $this->assertFalse(Discipline::start('success123')->upperCase()->isPass());
        $this->assertFalse(Discipline::start('Fail')->upperCase()->isPass());
        $this->assertFalse(Discipline::start('mr.x')->upperCase()->isPass());
        $this->assertFalse(Discipline::start(true)->upperCase()->isPass());
        $this->assertFalse(Discipline::start(null)->upperCase()->isPass());
        $this->assertFalse(Discipline::start('')->upperCase()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->upperCase()->isPass());
    }


    public function testNull()
    {
        $this->assertTrue(Discipline::start(null)->null()->isPass());

        $this->assertFalse(Discipline::start('ok')->null()->isPass());
        $this->assertFalse(Discipline::start(42)->null()->isPass());
        $this->assertFalse(Discipline::start(0)->null()->isPass());
        $this->assertFalse(Discipline::start(false)->null()->isPass());
        $this->assertFalse(Discipline::start('')->null()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->null()->isPass());
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

    public function testBlank()
    {
        $this->assertTrue(Discipline::start('')->blank()->isPass());

        $this->assertFalse(Discipline::start('ok')->blank()->isPass());
        $this->assertFalse(Discipline::start(42)->blank()->isPass());
        $this->assertFalse(Discipline::start(0)->blank()->isPass());
        $this->assertFalse(Discipline::start(false)->blank()->isPass());
        $this->assertFalse(Discipline::start(null)->blank()->isPass());
        $this->assertFalse(Discipline::start(array('NG'))->blank()->isPass());
    }

    public function testNotBlank()
    {
        $this->assertTrue(Discipline::start('ok')->notBlank()->isPass());
        $this->assertTrue(Discipline::start(42)->notBlank()->isPass());
        $this->assertTrue(Discipline::start(0)->notBlank()->isPass());
        $this->assertTrue(Discipline::start(false)->notBlank()->isPass());
        $this->assertTrue(Discipline::start(null)->notBlank()->isPass());
        $this->assertTrue(Discipline::start(array('NG'))->notBlank()->isPass());

        $this->assertFalse(Discipline::start('')->notBlank()->isPass());
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

        $this->assertTrue(Discipline::start('abcdef')->equals('abcdef')->isPass());
        $this->assertFalse(Discipline::start('abcdef')->equals('ABCDEF')->isPass());
        $this->assertTrue(Discipline::start('日本語')->equals('日本語')->isPass());

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

        $this->assertTrue(Discipline::start("日本語が使える")->contains("日本語")->isPass());
        $this->assertTrue(Discipline::start("日本語が使える")->contains("が")->isPass());
        $this->assertFalse(Discipline::start("日本語が使える")->contains("か")->isPass());

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

        $this->assertFalse(Discipline::start("日本語が使える")->notContains("日本語")->isPass());
        $this->assertTrue(Discipline::start("日本語が使える")->notContains("か")->isPass());

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

        $this->assertTrue(Discipline::start("abcdef")->length(6, 6)->isPass());
        $this->assertTrue(Discipline::start("abcdef")->length(6)->isPass());
        $this->assertFalse(Discipline::start("abcdef")->length(7)->isPass());

        $this->assertTrue(Discipline::start("日本語")->length(3, 3)->isPass());
        $this->assertFalse(Discipline::start("日本語")->length(4)->isPass());
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

    public function testEmail()
    {
        $this->assertTrue(Discipline::start("foo@example.com")->email()->isPass());
        $this->assertTrue(Discipline::start("foo.bar@mail.example.com")->email()->isPass());
        $this->assertTrue(Discipline::start("foo+bar@mail.example.com")->email()->isPass());

        $this->assertFalse(Discipline::start("mail.example.com")->email()->isPass());
        $this->assertFalse(Discipline::start("foo@")->email()->isPass());
        $this->assertFalse(Discipline::start("foo@example")->email()->isPass());

        $this->assertFalse(Discipline::start("foo..bar@example.com")->email()->isPass());
        $this->assertFalse(Discipline::start("foo.bar.@example.com")->email()->isPass());
        $this->assertFalse(Discipline::start(".foo.bar@example.com")->email()->isPass());
    }

    public function testUrl()
    {
        $this->assertTrue(Discipline::start("http://example.com")->url()->isPass());
        $this->assertTrue(Discipline::start("https://example.com/")->url()->isPass());
        $this->assertTrue(Discipline::start("http://example.com/path/to")->url()->isPass());
        $this->assertTrue(Discipline::start("http://example.com:8080")->url()->isPass());
        $this->assertTrue(Discipline::start("http://user:pass@example.com")->url()->isPass());
        $this->assertTrue(Discipline::start("http://localhost")->url()->isPass());
        $this->assertTrue(Discipline::start("http://192.168.0.1/")->url()->isPass());
        $this->assertTrue(Discipline::start("http://10.0.0.0/")->url()->isPass());
        $this->assertTrue(Discipline::start("ftp://example.com")->url()->isPass());
        $this->assertTrue(Discipline::start("mailto:foo@example.com")->url()->isPass());
        $this->assertTrue(Discipline::start("http://example.com?q=%2F&page=1")->url()->isPass());
        $this->assertTrue(Discipline::start("http://example.com/path/to$-_.+!*'(),")->url()->isPass());

        $this->assertFalse(Discipline::start("example.com")->url()->isPass());
        $this->assertFalse(Discipline::start("http://example.")->url()->isPass());
        $this->assertFalse(Discipline::start("http//example.com")->url()->isPass());
        $this->assertFalse(Discipline::start("http:/example.com")->url()->isPass());
        $this->assertFalse(Discipline::start("http:example.com")->url()->isPass());
        $this->assertFalse(Discipline::start("http://.com")->url()->isPass());
    }

    public function testIpv4()
    {
        $this->assertTrue(Discipline::start("127.0.0.1")->ipv4()->isPass());
        $this->assertTrue(Discipline::start("1.2.3.4")->ipv4()->isPass());
        $this->assertTrue(Discipline::start("0.0.0.0")->ipv4()->isPass());
        $this->assertTrue(Discipline::start("255.255.255.255")->ipv4()->isPass());

        $this->assertFalse(Discipline::start("1.2.3.4.5")->ipv4()->isPass());
        $this->assertFalse(Discipline::start("1.2.3.a")->ipv4()->isPass());
        $this->assertFalse(Discipline::start("256.0.0.0")->ipv4()->isPass());
        $this->assertFalse(Discipline::start("0.256.0.0")->ipv4()->isPass());
        $this->assertFalse(Discipline::start("0.0.256.0")->ipv4()->isPass());
        $this->assertFalse(Discipline::start("0.0.0.256")->ipv4()->isPass());

        $this->assertFalse(Discipline::start("::")->ipv4()->isPass());
        $this->assertFalse(Discipline::start("::1")->ipv4()->isPass());

        $this->assertFalse(Discipline::start("2001:db8:bd05:1d2:288a:1fc0:1:10ee")->ipv4()->isPass());
        $this->assertFalse(Discipline::start("ffff:ffff:ffff:ffff:ffff:ffff:ffff:ffff")->ipv4()->isPass());
        $this->assertFalse(Discipline::start("2001:db8::1234:0:0:9abc")->ipv4()->isPass());
        $this->assertFalse(Discipline::start("2001:db8::9abc")->ipv4()->isPass());
    }

    public function testIpv6()
    {
        $this->assertTrue(Discipline::start("::")->ipv6()->isPass());
        $this->assertTrue(Discipline::start("::f")->ipv6()->isPass());

        $this->assertTrue(Discipline::start("2001:db8:bd05:1d2:288a:1fc0:1:10ee")->ipv6()->isPass());
        $this->assertTrue(Discipline::start("ffff:ffff:ffff:ffff:ffff:ffff:ffff:ffff")->ipv6()->isPass());
        $this->assertTrue(Discipline::start("2001:db8::1234:0:0:9abc")->ipv6()->isPass());
        $this->assertTrue(Discipline::start("2001:db8::9abc")->ipv6()->isPass());

        $this->assertFalse(Discipline::start("::g")->ipv6()->isPass());
        $this->assertFalse(Discipline::start("1234:5::xyz")->ipv6()->isPass());

        $this->assertFalse(Discipline::start("127.0.0.1")->ipv6()->isPass());
    }


    public function testIp()
    {
        $this->assertTrue(Discipline::start("127.0.0.1")->ip()->isPass());
        $this->assertTrue(Discipline::start("1.2.3.4")->ip()->isPass());
        $this->assertTrue(Discipline::start("0.0.0.0")->ip()->isPass());
        $this->assertTrue(Discipline::start("255.255.255.255")->ip()->isPass());

        $this->assertTrue(Discipline::start("::")->ip()->isPass());
        $this->assertTrue(Discipline::start("::1")->ip()->isPass());
        $this->assertTrue(Discipline::start("2001:db8:bd05:1d2:288a:1fc0:1:10ee")->ip()->isPass());
        $this->assertTrue(Discipline::start("ffff:ffff:ffff:ffff:ffff:ffff:ffff:ffff")->ip()->isPass());
        $this->assertTrue(Discipline::start("2001:db8::1234:0:0:9abc")->ip()->isPass());
        $this->assertTrue(Discipline::start("2001:db8::9abc")->ip()->isPass());

        $this->assertFalse(Discipline::start("1.2.3.4.5")->ip()->isPass());
        $this->assertFalse(Discipline::start("1.2.3.a")->ip()->isPass());
        $this->assertFalse(Discipline::start("256.0.0.0")->ip()->isPass());
        $this->assertFalse(Discipline::start("0.256.0.0")->ip()->isPass());
        $this->assertFalse(Discipline::start("0.0.256.0")->ip()->isPass());
        $this->assertFalse(Discipline::start("0.0.0.256")->ip()->isPass());

        $this->assertFalse(Discipline::start("::g")->ip()->isPass());
        $this->assertFalse(Discipline::start("1234:5::xyz")->ip()->isPass());
    }

    public function testRunSpecificFunction()
    {
        $testCheckerClass = new DisciplineTestRunChecker();

        $checkerFunction = function ($value) use ($testCheckerClass) {
            return $testCheckerClass->invoke($value);
        };

        $this->assertTrue(Discipline::start(1)->run(array($testCheckerClass, 'invoke'))->isPass());
        $this->assertTrue(Discipline::start(2)->run(array('\Kumatch\Test\Discipline\DisciplineTestRunChecker', 'invoke'))->isPass());
        $this->assertTrue(Discipline::start(3)->run($checkerFunction)->isPass());

        $this->assertFalse(Discipline::start(null)->run(array($testCheckerClass, 'invoke'))->isPass());
        $this->assertFalse(Discipline::start("foo")->run(array('\Kumatch\Test\Discipline\DisciplineTestRunChecker', 'invoke'))->isPass());
        $this->assertFalse(Discipline::start(-1)->run($checkerFunction)->isPass());
    }
}