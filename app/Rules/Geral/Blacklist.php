<?php

namespace App\Rules\Geral;

use Illuminate\Contracts\Validation\Rule;

use App\Services\BlacklistService;

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
        $this->blacklist = new BlacklistService;
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
        return !BlacklistService::blacklist($attribute, $value);
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
