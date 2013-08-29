<?php

namespace Kumatch\Discipline;

class Discipline
{

    protected $value;
    protected $message;
    protected $result = true;

    /**
     * @param $value
     * @param string $message
     * @return Discipline
     */
    static public function start($value, $message = 'failed')
    {
        return new self($value, $message);
    }

    /**
     * @param $value
     * @param string $message
     */
    public function __construct($value, $message = 'failed')
    {
        $this->value = $value;
        $this->message = $message;
    }

    /**
     * @return bool
     */
    public function isPass()
    {
        return $this->result;
    }

    /**
     * @return $this
     */
    public function fail()
    {
        $this->result = false;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }




    /**
     * @param bool $strict
     * @return $this
     */
    public function int($strict = true)
    {
        if (is_int($this->value)) {
            return $this;
        }

        if ($strict) {
            return $this->fail();
        }

        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (is_bool($this->value)) {
            return $this->fail();
        }

        if (!preg_match('/^-?(?:0|[1-9][0-9]*)$/', $this->value)) {
            return $this->fail();
        }

        return $this;
    }

    /**
     * alias isInt()
     *
     * @param bool $strict
     * @return $this
     */
    public function integer($strict = true)
    {
        return $this->int($strict);
    }


    /**
     * @param bool $strict
     * @return $this
     */
    public function float($strict = true)
    {
        if (is_float($this->value)) {
            return $this;
        }

        if ($strict) {
            return $this->fail();
        }

        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (is_bool($this->value)) {
            return $this->fail();
        }

        if (is_null($this->value) || $this->value === '') {
            return $this->fail();
        }

        if (!preg_match('/^(?:-?(?:[0-9]+))?(?:\.[0-9]*)?(?:[eE][\+\-]?(?:[0-9]+))?$/', $this->value)) {
            return $this->fail();
        }

        return $this;
    }

    /**
     * alias isFloat()
     *
     * @return $this
     */
    public function decimal()
    {
        return $this->float();
    }


    /**
     * @return $this
     */
    public function alpha()
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (is_bool($this->value)) {
            return $this->fail();
        }

        if (!preg_match('/^[a-zA-Z]+$/', $this->value)) {
            return $this->fail();
        }

        return $this;
    }

    /**
     * alias isAlpha()
     *
     * @return $this
     */
    public function alphabet()
    {
        return $this->alpha();
    }


    /**
     * @return $this
     */
    public function alphaNumeric()
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (is_bool($this->value)) {
            return $this->fail();
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $this->value)) {
            return $this->fail();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function numeric()
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (is_bool($this->value)) {
            return $this->fail();
        }

        if (!preg_match('/^-?[0-9]+$/', $this->value)) {
            return $this->fail();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function lowerCase()
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (is_bool($this->value)) {
            return $this->fail();
        }

        if (is_null($this->value) || $this->value === '') {
            return $this->fail();
        }

        if ((string)$this->value !== strtolower($this->value)) {
            return $this->fail();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function upperCase()
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (is_bool($this->value)) {
            return $this->fail();
        }

        if (is_null($this->value) || $this->value === '') {
            return $this->fail();
        }

        if ((string)$this->value !== strtoupper($this->value)) {
            return $this->fail();
        }

        return $this;
    }



    /**
     * @return $this
     */
    public function null()
    {
        if (!is_null($this->value)) {
            return $this->fail();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function notNull()
    {
        if (is_null($this->value)) {
            return $this->fail();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function blank()
    {
        if ($this->value === '') {
            return $this;
        } else {
            return $this->fail();
        }
    }

    /**
     * @return $this
     */
    public function notBlank()
    {
        if ($this->value === '') {
            return $this->fail();
        } else {
            return $this;
        }
    }

    /**
     * @param $equals
     * @return $this
     */
    public function equals($equals)
    {
        if (serialize($this->value) === serialize($equals)) {
            return $this;
        } else {
            return $this->fail();
        }
    }

    /**
     * @param $equals
     * @return $this
     */
    public function notEquals($equals)
    {
        if (serialize($this->value) !== serialize($equals)) {
            return $this;
        } else {
            return $this->fail();
        }
    }

    /**
     * @param $part
     * @return $this
     */
    public function contains($part)
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (is_null($this->value)) {
            return $this->fail();
        }

        if ($part === "") {
            return $this;
        }

        $pos = strpos($this->value, $part);

        if (is_numeric($pos) && $pos >= 0) {
            return $this;
        } else {
            return $this->fail();
        }
    }

    /**
     * @param $part
     * @return $this
     */
    public function notContains($part)
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (is_null($this->value)) {
            return $this->fail();
        }

        if ($part === "") {
            return $this->fail();
        }

        $pos = strpos($this->value, $part);

        if (is_numeric($pos) && $pos >= 0) {
            return $this->fail();
        } else {
            return $this;
        }
    }

    /**
     * @param $pattern
     * @return $this
     */
    public function match($pattern)
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (preg_match($pattern, $this->value)) {
            return $this;
        } else {
            return $this->fail();
        }
    }

    /**
     * @param $pattern
     * @return $this
     */
    public function notMatch($pattern)
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (preg_match($pattern, $this->value)) {
            return $this->fail();
        } else {
            return $this;
        }
    }

    /**
     * @param int $min
     * @param int|null $max
     * @return $this
     */
    public function length($min, $max = null)
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        $length = strlen($this->value);

        if ($length < $min) {
            return $this->fail();
        }

        if (!is_null($max) && ($length > $max)) {
            return $this->fail();
        }

        return $this;
    }

    /**
     * @param $min
     * @return $this
     */
    public function min($min)
    {
        if (!is_numeric($this->value)) {
            return $this->fail();
        }

        if ($this->value < $min) {
            return $this->fail();
        }

        return $this;
    }

    /**
     * @param $max
     * @return $this
     */
    public function max($max)
    {
        if (!is_numeric($this->value)) {
            return $this->fail();
        }

        if ($this->value > $max) {
            return $this->fail();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function email()
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            return $this;
        } else {
            return $this->fail();
        }
    }

    /**
     * @return $this
     */
    public function url()
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (filter_var($this->value, FILTER_VALIDATE_URL)) {
            return $this;
        } else {
            return $this->fail();
        }
    }

    /**
     * @return $this
     */
    public function ipv4()
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (filter_var($this->value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $this;
        } else {
            return $this->fail();
        }
    }

    /**
     * @return $this
     */
    public function ipv6()
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (filter_var($this->value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return $this;
        } else {
            return $this->fail();
        }
    }

    /**
     * @return $this
     */
    public function ip()
    {
        if (!is_scalar($this->value)) {
            return $this->fail();
        }

        if (filter_var($this->value, FILTER_VALIDATE_IP)) {
            return $this;
        } else {
            return $this->fail();
        }
    }

}