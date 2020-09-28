<?php

namespace App\Services\PhoneNumber;

class ValidationPhoneNumberService extends Illuminate\Validation\Validator{

    /**
     * O número de telefone sem tratamento.
     *
     * @var string
     */
    private $phone;

    /**
     * O número de DDD, deve conter 2 dígitos
     *
     * @var int
     */
    private $ddd;

    /**
     * O número do telefone sem o DDD, deve conter 9 dígitos
     *
     * @var int
     */
    private $number;

    /**
     * Boolean que informa se é um número válido
     *
     * @var boolean
     */
    private $isValid;

    /**
     * Boolean que informa se o número esta em BlackList
     *
     * @var string
     */
    private $isBlocked;

    /**
     * Construtor publico. Usado para obter uma instância.
     *
     * @param string $phone Numero de telefone que será validado.
     */
    public function __construct(string $phone)
    {
        $this->phone = $phone;

        $this->ddd = substr($phone, 0, 2);
        $this->number = substr($phone, 2);
    }
}
