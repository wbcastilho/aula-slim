<?php

namespace tests\app\validators;

use app\validators\NumericValidator;
use PHPUnit\Framework\TestCase;

class NumericValidatorTest extends TestCase
{    
    /**
     * @dataProvider valueProvider
     */
    public function testIsValid($value, $expectedResult)
    {
        $numericValidator = new NumericValidator($value);

        $isValid = $numericValidator->isValid();

        $this->assertEquals($expectedResult, $isValid);
    }

    public static function valueProvider()
    {
        return [
            'shouldBeValidWhenValueIsANumber' => ['value' => 20, 'expectedResult' => true],
            'shouldBeValidWhenValueIsANumericString' => ['value' => '20', 'expectedResult' => true],
            'shouldNotBeValidWhenValueIsEmpty' => ['value' => '', 'expectedResult' => false],
            'shouldNotBeValidWhenValueIsNotANumber' => ['value' => 'bla', 'expectedResult' => false]
        ];
    }
}