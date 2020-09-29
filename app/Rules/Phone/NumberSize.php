<?php

namespace App\Rules\Phone;

use Illuminate\Contracts\Validation\Rule;

class NumberSize implements Rule
{
    private $size;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($size)
    {
        $this->size = $size;
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
        return $this->size == strlen($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Quantidade de dígitos invalida';
    }
}
