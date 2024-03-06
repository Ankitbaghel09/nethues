<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
//use Illuminate\Contracts\Validation\Rule;

class InEnum implements ValidationRule
{
    protected $enumValues;

    public function __construct(array $enumValues)
    {
        $this->enumValues = $enumValues;
    }

    public function passes($attribute, $value)
    {
        return in_array($value, $this->enumValues);
    }

    public function message()
    {
        return 'The selected :attribute is invalid.';
    }
}
