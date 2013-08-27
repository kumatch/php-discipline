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
    public function isInt($strict = true)
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
    public function isInteger($strict = true)
    {
        return $this->int($strict);
    }




    /**
     * @return $this
     */
    public function isAlpha()
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
    public function isAlphabet()
    {
        return $this->isAlpha();
    }


    /**
     * @return $this
     */
    public function isAlphaNumeric()
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
    public function isNumeric()
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
    public function isLowerCase()
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
    public function isUpperCase()
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
    public function isFloat()
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
    public function isDecimal()
    {
        return $this->isFloat();
    }



    /**
     * @return $this
     */
    public function isNull()
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
    public function isEmpty()
    {
        if (is_null($this->value) || $this->value === '') {
            return $this;
        } else {
            return $this->fail();
        }
    }

    /**
     * @return $this
     */
    public function notEmpty()
    {
        if (is_null($this->value) || $this->value === '') {
            return $this->fail();
        } else {
            return $this;
        }
    }
}