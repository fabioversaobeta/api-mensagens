<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;

use App\Rules\Geral\Blacklist;

class BlacklistTest extends TestCase
{
    protected $suitableService;

    public function setUp() : void
    {
        // $this->suitableService = new SuitableMessagesService();
    }

    /**
     * mensagens que estão na blacklist deverão ser bloqueadas;
     *
     * @return void
     */
    public function testMessagesThatAreaOnTheBlacklistSouldBeBlocked()
    {
        $phone = '990171682';

        $this->rule = new Blacklist();

        $this->assertFalse($this->rule->passes('test', $phone));
    }

    /**
     * mensagens que estão na blacklist deverão ser bloqueadas;
     *
     * @return void
     */
    public function testMessagesThatNotOnTheBlacklist()
    {
        $phone = '984395789';

        $this->rule = new Blacklist();

        $this->assertTrue($this->rule->passes('test', $phone));
    }
}
