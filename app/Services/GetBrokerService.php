<?php

namespace App\Services;

class GetBrokerService
{
    private $brokers;

    /**
     * Lista de Operadores e seus respectivos Brokers
     */
    public function __construct()
    {
        $this->brokers = [
            'VIVO' => 1,
            'TIM' => 1,
            'CLARO' => 2,
            'OI' => 2,
            'NEXTEL' => 3
        ];
    }

    /**
     * Retorna uma lista contendo IDMENSAGEM e IDBLOKER
     *
     * @return Array
     */
    public function brokers($list)
    {
        return $list->map(function ($value) {
            return [
                'IDMENSAGEM' => $value['IDMENSAGEM'],
                'IDBROKER' => $this->getBroker($value['OPERADORA'])
            ];
        });
    }

    /**
     * Retorna o Broker específico da operadora informada
     */
    public function getBroker($operator)
    {
        return $this->brokers[$operator];
    }
}
