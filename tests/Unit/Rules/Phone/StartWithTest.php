<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;

use App\Rules\Phone\StartWith;

class StartWithTest extends TestCase
{
    protected $suitableService;

    public function setUp() : void
    {
        // $this->suitableService = new SuitableMessagesService();
    }

    /**
     * Número do celular bloqueado se não começar com 9;
     */
    public function testPhoneNumberBlockedIfNotStartWithNine()
    {
        $phone = '200171628';

        $this->rule = new StartWith(9);

        $this->assertFalse($this->rule->passes('test', $phone));
    }

    /**
     * Número do celular deve começar com 9;
     */
    public function testPhoneNumberMusteStartWithNine()
    {
        $phone = '990171628';

        $this->rule = new StartWith(9);

        $this->assertTrue($this->rule->passes('test', $phone));
    }
}
