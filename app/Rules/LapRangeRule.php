<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LapRangeRule implements ValidationRule
{
    /**
     * Run the validation rule.
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        [$first, $second] = explode('-', $value);
        if (!(int)$first || !(int)$second || $first > $second) {
            $fail("The $attribute value must be in the format 3-33!");
        }
    }
}
