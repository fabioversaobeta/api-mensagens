<?php

namespace App\Rules\Geral;

use Illuminate\Contracts\Validation\Rule;

class SchedulingAfter implements Rule
{
    private $hour;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($hour)
    {
        $this->hour = $hour;
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
        return !(strtotime($value) > strtotime($this->hour));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Agendamento fora de horário';
    }
}
