<?php

namespace App\Rules\Phone;

use Illuminate\Contracts\Validation\Rule;

class SecondDigitGreaterThan implements Rule
{
    private $number;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($number)
    {
        $this->number;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return intval(substr($value, 1, 1)) > intval($this->number);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
