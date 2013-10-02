<?php

namespace Kumatch\Discipline;

interface RuleInterface
{
    public function int($strict = true);
    public function integer($strict = true);
    public function float($strict = true);
    public function decimal($strict = true);
    public function alpha();
    public function alphabet();
    public function alphaNumeric();
    public function numeric();
    public function ascii();
    public function lowerCase();
    public function upperCase();
    public function null();
    public function notNull();
    public function blank();
    public function notBlank();
    public function equals($equals);
    public function notEquals($equals);
    public function contains($part);
    public function notContains($part);
    public function match($pattern);
    public function notMatch($pattern);
    public function length($min, $max = null);
    public function min($min);
    public function max($max);
    public function email();
    public function url();
    public function ipv4();
    public function ipv6();
    public function ip();
    public function run($checker);
}