<?php

namespace App\Rules\Geral;

use Illuminate\Contracts\Validation\Rule;

class CharacterLimit implements Rule
{
    private $limit;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($limit)
    {
        $this->limit = $limit;
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
        return !(strlen($value) > 140);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tamanho da mensagem maior que ' . $this->limit . ' caracteres';
    }
}
