<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;

use App\Rules\Geral\BlockedUf;

class BlockedUfTest extends TestCase
{
    protected $suitableService;

    public function setUp() : void
    {
        // $this->suitableService = new SuitableMessagesService();
    }

    /**
     * mensagens para o estado de São Paulo deverão ser bloqueadas;
     *
     * @return void
     */
    public function testMessagesToTheStateOfSaoPauloSouldBeBlockedTest()
    {
        $this->rule = new BlockedUf(['SP']);

        $this->assertFalse($this->rule->passes('test', 12));
    }

    /**
     * mensagens para o estado de São Paulo deverão ser bloqueadas;
     *
     * @return void
     */
    public function testMessagesToTheAnyStateNotSouldBeBlockedTest()
    {
        $this->rule = new BlockedUf(['SP']);

        $this->assertTrue($this->rule->passes('test', 41));
    }
}
