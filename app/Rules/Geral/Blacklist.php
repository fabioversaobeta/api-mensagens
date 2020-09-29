<?php

namespace App\Rules\Geral;

use Illuminate\Contracts\Validation\Rule;

class Blacklist implements Rule
{
    private $blacklist;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->blacklist = [
            '990171682',
            '990171683',
            '990171684'
        ];
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
        return !in_array($value, $this->blacklist);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Número esta na Blacklist.';
    }
}
