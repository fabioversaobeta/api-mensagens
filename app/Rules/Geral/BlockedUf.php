<?php

namespace App\Rules\Geral;

use Illuminate\Contracts\Validation\Rule;

class BlockedUf implements Rule
{
    private $list;
    private $ufs;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($ufs)
    {
        $this->ufs = $ufs;
        $this->list = [
            "SP" => [11, 12, 13, 14, 15, 16, 17, 18, 19],
            "RJ" => [21, 22, 24],
            "ES" => [27, 28],
            "MG" => [31, 32, 33, 34, 35, 37, 38],
            "PR" => [41, 42, 43, 44, 45, 46],
            "SC" => [47, 48, 49],
            "RS" => [51, 53, 54, 55],
            "DF" => [61],
            "GO" => [62, 64],
            "TO" => [63],
            "MT" => [65, 66],
            "MS" => [67],
            "AC" => [68]
            // 69 => "RO",
            // 71 => "BA",
            // 73 => "BA",
            // 74 => "BA",
            // 75 => "BA",
            // 77 => "BA",
            // 79 => "SE",
            // 81 => "PE",
            // 82 => "AL",
            // 83 => "PB",
            // 84 => "RN",
            // 85 => "CE",
            // 86 => "PI",
            // 87 => "PE",
            // 88 => "CE",
            // 89 => "PI",
            // 91 => "PA",
            // 92 => "AM",
            // 93 => "PA",
            // 94 => "PA",
            // 95 => "RR",
            // 96 => "AP",
            // 97 => "AM",
            // 98 => "MA",
            // 99 => "MA"
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
        $strList = '';

        foreach ($this->ufs as $key => $uf) {
            $strList .= implode(',', $this->list[$uf]) . ',';
        }

        $arList = explode(',', $strList);

        return !in_array($value, $arList);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'DDD Bloqueado';
    }
}
