<?php

namespace App\Services;

class GetBrokerService
{
    private $brokers;

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

    public function brokers($list)
    {
        return $list->map(function ($value) {
            return [
                'IDMENSAGEM' => $value['IDMENSAGEM'],
                'IDBROKER' => $this->getBroker($value['OPERADORA'])
            ];
        });
    }

    public function getBroker($operator)
    {
        return $this->brokers[$operator];
    }
}
