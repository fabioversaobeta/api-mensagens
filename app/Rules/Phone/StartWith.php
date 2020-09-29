<?php

namespace App\Rules\Phone;

use Illuminate\Contracts\Validation\Rule;

class StartWith implements Rule
{
    private $start;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($start)
    {
        $this->start = $start;
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
        $val1 = intval(substr($value, 0, 1));
        $val2 = intval($this->start);

        return ($val1 == $val2 ? true : false);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Não iniciou com ' . $this->start;
    }
}
