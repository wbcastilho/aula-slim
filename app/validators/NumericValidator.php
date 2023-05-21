<?php

namespace app\validators;

class NumericValidator
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function isValid()
    {
        return is_numeric($this->value);
    }
}