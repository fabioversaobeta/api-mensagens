<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PhoneNumberTest extends TestCase
{
    /*
        o id_broker será definido conforme a operadora; (ver broker x operadora)
    */

    /**
     * mensagens com telefone inválido deverão ser bloqueadas(DDD+NUMERO);
     *
     * @return void
     */
    public function messagesWithInvalidPhoneShouldBeBlocked()
    {
        $phone = '008376';

        $idValid = validatePhoneNumberMethod($phone);

        $this->assertFalse($idValid);
    }

    /**
     * mensagens que estão na blacklist deverão ser bloqueadas;
     *
     * @return void
     */
    public function messagesThatAreaOnTheBlacklistSouldBeBlockedTest()
    {
        $phone = 41984395789;

        $idValid = validPhoneNumberInBlacklist($phone);

        $this->assertFalse($idValid);
    }

    /**
     * mensagens para o estado de São Paulo deverão ser bloqueadas;
     *
     * @return void
     */
    public function messagesToTheStateOfSaoPauloSouldBeBlocked()
    {
        $phone = 11984395789;

        $idValid = validPhoneNumberState($phone);

        $this->assertFalse($idValid);
    }

    /**
     * mensagens para o estado de São Paulo deverão ser bloqueadas;
     *
     * @return void
     */
    public function messagesScheduledAfter195959ShouldBeBlocked()
    {
        $message = [
            "hour" => "20:00:00"
        ];

        $idValid = validMessageSchedule($message);

        $this->assertFalse($idValid);
    }

    /**
     * as mensagens com mais de 140 caracteres deverão ser bloqueadas;
     *
     * @return void
     */
    public function messagesWithMoreThan140CharactersMustBeBlocked()
    {
        $message = [
            "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam malesuada eget dolor at vulputate. Cras sed felis sem. Sed quis tempus nisl. Must than 140"
        ];

        $idValid = validMessageSize($message);

        $this->assertFalse($idValid);
    }

    /**
     * caso possua mais de uma mensagem para o mesmo destino,
     * apenas a mensagem apta com o menor horário deve ser considerada;
     *
     * @return void
     */
    public function moreThanOneMessageToTheSameDestinationConsiderTheMessageWithTheShortestTime()
    {
        $messages = [
            [
                "phone" => 41984395789
                "hour" => "12:00:00"
            ],
            [
                "phone" => 41984395789
                "hour" => "08:00:00"
            ],
        ];

        $greater = [
            [
                "phone" => 41984395789
                "hour" => "12:00:00"
            ]
        ];

        $less = [
            [
                "phone" => 41984395789
                "hour" => "08:00:00"
            ]
        ];

        $shortestMessages = returnShortestTime($messages);

        $this->assertNotContain($greater, $shortestMessages);

        $this->assertContain($less, $shortestMessages);
    }
}
