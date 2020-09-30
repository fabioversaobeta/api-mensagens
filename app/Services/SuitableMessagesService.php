<?php

namespace App\Services;

use App\Services\Utils\ConvertLinesService;

use App\Rules\Geral\BlockedUf;
use App\Rules\Geral\SchedulingAfter;
use App\Rules\Geral\Blacklist;
use App\Rules\Geral\CharacterLimit;

use App\Rules\Phone\ValidDDD;
use App\Rules\Phone\NumberSize;
use App\Rules\Phone\StartWith;
use App\Rules\Phone\SecondDigitGreaterThan;

use App\Services\GetBrokerService;

class SuitableMessagesService
{
    private $geralRules;
    private $phoneRules;

    /**
     * Inicia regras que irão validar as mensagens
     */
    public function __construct()
    {
        $this->geralRules = [
            'DDD' => [new BlockedUf(['SP'])],
            'DDDCELULAR' => [new Blacklist()],
            'HORARIO_ENVIO' => new SchedulingAfter('19:59:59'),
            'MENSAGEM' => new CharacterLimit(140)
        ];

        $this->phoneRules = [
            'DDD' => [new ValidDDD, new NumberSize(2)],
            'CELULAR' => [
                new NumberSize(9),
                new StartWith(9),
                new SecondDigitGreaterThan(6)
            ]
        ];
    }

    public function suitables($lines)
    {
        // Services
        $convertLinesService = new ConvertLinesService();
        $getBrokerService = new GetBrokerService();

        // Nome dos campos do arquivo para serem mapeados
        $headers = [
            "IDMENSAGEM",
            "DDD",
            "CELULAR",
            "OPERADORA",
            "HORARIO_ENVIO",
            "MENSAGEM"
        ];

        // Converte linhas do arquivo em uma Collection
        $messages = $convertLinesService->convertToColletion($lines, $headers);

        $messages = $this->makePhoneNumber($messages);

        // Valida regras gerais para bloquear mensagens inválidas
        $filtered = $messages->validate($this->geralRules);

        $filtered = $filtered->sortBy('HORARIO_ENVIO')->unique('DDDCELULAR');

        // Valida regras para bloquear telefone inválido
        $phoneFiltered = $filtered->validate($this->phoneRules);

        // retorna lista com IDMENSAGEM e IDBROKER
        $brokered = $getBrokerService->brokers($phoneFiltered);

        return $brokered;
    }

    /**
     * DDD + CELULAR
     */
    public function makePhoneNumber($list)
    {
        $collection = $list->map(function ($message) {
            $message['DDDCELULAR'] = $message['DDD'].$message['CELULAR'];
            return $message;
        });

        return $collection;
    }
}
