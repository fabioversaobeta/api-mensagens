<?php

namespace App\Rules\Phone;

use Illuminate\Contracts\Validation\Rule;

class ValidDDD implements Rule
{
    private $list;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->list = [
            11,12,13,14,15,16,17,18,19,21,22,24,27,28,31,32,33,34,35,37,38,
            41,42,43,44,45,46,47,48,49,51,53,54,55,61,62,63,64,65,66,67,68,
            69,71,73,74,75,77,79,81,82,83,84,85,86,87,88,89,91,92,93,94,95,
            96,97,98,99
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
        return in_array($value, $this->list);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'DDD inexistente';
    }
}
