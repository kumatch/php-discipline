<?php

namespace Kumatch\Discipline;

class DefinitionParameter
{
    /** @var string  */
    protected $method;
    /** @var array  */
    protected $arguments = array();

    /**
     * @param string $method
     * @param array $arguments
     */
    public function __construct($method, $arguments = array())
    {
        $this->method = $method;;
        $this->arguments = $arguments;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }
}