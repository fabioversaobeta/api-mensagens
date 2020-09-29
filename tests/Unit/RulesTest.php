<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Services\SuitableMessagesService;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class RulesTest extends TestCase
{
    protected $suitableService;

    public function setUp()
    {
        $this->suitableService = new SuitableMessagesService();
    }

    /**
     * mensagens com telefone inválido deverão ser bloqueadas(DDD+NUMERO);
     *
     * @return void
     */
    public function testMessagesWithInvalidPhoneShouldBeBlocked()
    {
        // $this->suitableService =  new SuitableMessagesService();

        // Collection::macro('validate', function (array $rules) {
        //     /** @var $this Collection */
        //     return $this->values()->reject(function ($array) use ($rules) {
        //         return Validator::make($array, $rules)->fails();
        //     });
        // });

        $file = [
            'e7b87f43-9aa8-414b-9cec-f28e653ac25e;69;84930612;CLARO;19:05:21;justo lacinia eget tincidunt eget',
            'b7e2af69-ce52-4812-adf1-395c8875ad30;70;984930612;CLARO;19:05:21;justo lacinia eget tincidunt eget',
            'c04096fe-2878-4485-886b-4a68a259bac5;21;924930612;CLARO;19:05:21;justo lacinia eget tincidunt eget',
            'bff58d7b-8b4a-456a-b852-5a3e000c0e63;41;292930612;CLARO;19:05:21;justo lacinia eget tincidunt eget'
        ];

        $suitables = $this->suitableService->suitables($file);

        $size = sizeof($suitables);

        $this->assertEqual(0, $size);
    }

    /**
     * mensagens que estão na blacklist deverão ser bloqueadas;
     *
     * @return void
     */
    public function testMessagesThatAreaOnTheBlacklistSouldBeBlockedTest()
    {
        $file = [
            'e7b87f43-9aa8-414b-9cec-f28e653ac25e;34;990171682;VIVO;18:35:20;dui luctus rutrum nulla tellus in sagittis dui',
            'c04096fe-2878-4485-886b-4a68a259bac5;43;940513739;NEXTEL;14:54:16;nibh fusce lacus purus aliquet at feugiat'
        ];

        $suitables = $this->suitableService->suitables($file);

        $size = sizeof($suitables);

        $this->assertEqual(1, $size);
    }

    /**
     * mensagens para o estado de São Paulo deverão ser bloqueadas;
     *
     * @return void
     */
    public function testMessagesToTheStateOfSaoPauloSouldBeBlockedTest()
    {
        $file = [
            'bff58d7b-8b4a-456a-b852-5a3e000c0e63;12;996958849;NEXTEL;08:24:03;sapien sapien non mi integer ac neque duis bibendum',
            'b7e2af69-ce52-4812-adf1-395c8875ad30;12;996958849;NEXTEL;09:24:03;sapien sapien non mi integer ac neque duis bibendum'
        ];

        $suitables = $this->suitableService->suitables($file);

        $size = sizeof($suitables);

        $this->assertEqual(0, $size);
    }

    /**
     * mensagens para agendadas após às 19:59:59 serão bloqueadas;
     *
     * @return void
     */
    public function testMessagesScheduledAfter195959ShouldBeBlockedTest()
    {
        $file = [
            'bff58d7b-8b4a-456a-b852-5a3e000c0e63;41;996958849;NEXTEL;21:24:03;sapien sapien non mi integer ac neque duis bibendum',
            'b7e2af69-ce52-4812-adf1-395c8875ad30;41;996958849;NEXTEL;20:24:03;sapien sapien non mi integer ac neque duis bibendum'
        ];

        $suitables = $this->suitableService->suitables($file);

        $size = sizeof($suitables);

        $this->assertEqual(0, $size);
    }

    /**
     * as mensagens com mais de 140 caracteres deverão ser bloqueadas;
     *
     * @return void
     */
    public function testMessagesWithMoreThan140CharactersMustBeBlockedTest()
    {
        $file = [
            'd81b2696-8b62-4b8b-af82-586ce0875ebc;21;983522711;TIM;16:42:48;sit amet eros suspendisse accumsan tortor quis turpis sed ante sit amet eros suspendisse accumsan tortor quis turpis sed ante sit amet eros suspendisse accumsan tortor quis turpis sed ante'
        ];

        $suitables = $this->suitableService->suitables($file);

        $size = sizeof($suitables);

        $this->assertEqual(0, $size);
    }

    /**
     * caso possua mais de uma mensagem para o mesmo destino,
     * apenas a mensagem apta com o menor horário deve ser considerada;
     *
     * @return void
     */
    public function testMoreThanOneMessageToTheSameDestinationConsiderTheMessageWithTheShortestTimeTest()
    {
        $file = [
            'bff58d7b-8b4a-456a-b852-5a3e000c0e63;41;996958849;NEXTEL;15:24:03;sapien sapien non mi integer ac neque duis bibendum',
            'b7e2af69-ce52-4812-adf1-395c8875ad30;41;996958849;NEXTEL;12:05:21;justo lacinia eget tincidunt eget'
        ];

        $suitables = $this->suitableService->suitables($file);

        $id = $suitables[0]['IDMENSAGEM'];

        $this->assertEqual('b7e2af69-ce52-4812-adf1-395c8875ad30', $id);
    }

    /**
     * o id_broker será definido conforme a operadora;
     *
     * @return void
     */
    public function testBrokerWillBeDefinedAccordingToTheOperatorTest()
    {
        $file = [
            'bff58d7b-8b4a-456a-b852-5a3e000c0e63;41;996958849;NEXTEL;15:24:03;sapien sapien non mi integer ac neque duis bibendum',
            'b7e2af69-ce52-4812-adf1-395c8875ad30;70;949360613;CLARO;19:05:21;justo lacinia eget tincidunt eget',
            'e7b87f43-9aa8-414b-9cec-f28e653ac25e;34;990171682;VIVO;18:35:20;dui luctus rutrum nulla tellus in sagittis dui'
        ];

        $suitables = $this->suitableService->suitables($file);

        $idNextel = $suitables[0]['IDBROKER'];
        $idClaro = $suitables[1]['IDBROKER'];
        $idVivo = $suitables[2]['IDBROKER'];

        $this->assertEqual(3, $idNextel);
        $this->assertEqual(2, $idClaro);
        $this->assertEqual(1, $idVivo);
    }
}
