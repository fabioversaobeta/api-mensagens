<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;

use App\Rules\Geral\SchedulingAfter;

class SchedulingAfterTest extends TestCase
{
    protected $suitableService;

    public function setUp() : void
    {
        // $this->suitableService = new SuitableMessagesService();
    }

    /**
     * mensagens para agendadas após às 19:59:59 serão bloqueadas;
     *
     * @return void
     */
    public function testMessagesScheduledAfter195959ShouldBeBlockedTest()
    {
        $hour = '20:30:00';

        $this->rule = new SchedulingAfter('19:59:59');

        $this->assertFalse($this->rule->passes('test', $hour));
    }

    /**
     * mensagens para agendadas após às 19:59:59 serão bloqueadas;
     *
     * @return void
     */
    public function testMessagesScheduledBefore195959Test()
    {
        $hour = '11:30:00';

        $this->rule = new SchedulingAfter('19:59:59');

        $this->assertTrue($this->rule->passes('test', $hour));
    }
}
