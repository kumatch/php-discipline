<?php

namespace Kumatch\Discipline;

use Kumatch\Discipline\RuleInterface;
use Kumatch\Discipline\Discipline;
use Kumatch\Discipline\DefinitionParameter;
use Kumatch\Discipline\Exception;

class Definition implements RuleInterface
{
    /** @var string|null  */
    protected $message;
    /** @var DefinitionParameter[] */
    protected $definitionParameters = array();

    /**
     * @param string $message
     */
    public function __construct($message = 'failed')
    {
        $this->message = $message;
    }

    /**
     * @param mixed $value
     * @return Discipline
     */
    public function invoke($value = null)
    {
        $discipline = new Discipline($value, $this->message);

        foreach ($this->definitionParameters as $definitionParameter) {
            call_user_func_array(array($discipline, $definitionParameter->getMethod()),
                $definitionParameter->getArguments());
        }

        return $discipline;
    }

    /**
     * @param $method
     * @param array $arguments
     * @return $this
     */
    protected function define($method, $arguments = array())
    {
        array_push($this->definitionParameters, new DefinitionParameter($method, $arguments));

        return $this;
    }


    /**
     * @param bool $strict
     * @return $this
     */
    public function int($strict = true)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * alias isInt()
     *
     * @param bool $strict
     * @return $this
     */
    public function integer($strict = true)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @param bool $strict
     * @return $this
     */
    public function float($strict = true)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * alias isFloat()
     *
     * @param bool $strict
     * @return $this
     */
    public function decimal($strict = true)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }


    /**
     * @return $this
     */
    public function alpha()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * alias isAlpha()
     *
     * @return $this
     */
    public function alphabet()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function alphaNumeric()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function numeric()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function ascii()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function lowerCase()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function upperCase()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }



    /**
     * @return $this
     */
    public function null()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function notNull()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function blank()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function notBlank()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @param $equals
     * @return $this
     */
    public function equals($equals)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @param $equals
     * @return $this
     */
    public function notEquals($equals)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @param $part
     * @return $this
     */
    public function contains($part)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @param $part
     * @return $this
     */
    public function notContains($part)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @param $pattern
     * @return $this
     */
    public function match($pattern)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @param $pattern
     * @return $this
     */
    public function notMatch($pattern)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @param int $min
     * @param int|null $max
     * @return $this
     */
    public function length($min, $max = null)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @param $min
     * @return $this
     */
    public function min($min)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @param $max
     * @return $this
     */
    public function max($max)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function email()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function url()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function ipv4()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function ipv6()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @return $this
     */
    public function ip()
    {
        return $this->define(__FUNCTION__, func_get_args());
    }

    /**
     * @param callable $checker
     * @throws Exception
     * @return $this
     */
    public function run($checker)
    {
        return $this->define(__FUNCTION__, func_get_args());
    }
}