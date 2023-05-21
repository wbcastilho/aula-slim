<?php

namespace app\validators;

class NotEmptyValidator
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function isValid()
    {
        return !empty($this->value);
    }
}