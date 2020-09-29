<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;

use App\Rules\Phone\SecondDigitGreaterThan;

class SecondDigitGreaterThanTest extends TestCase
{
    protected $suitableService;

    public function setUp() : void
    {
        // $this->suitableService = new SuitableMessagesService();
    }

    /**
     * O segundo dígito deve ser > 6 ou será bloqueado;
     */
    public function testSecundNumberMustBeGreaterThanSixOrBlocked()
    {
        $phone = '900171628';

        $this->rule = new SecondDigitGreaterThan(6);

        $this->assertFalse($this->rule->passes('test', $phone));
    }

    /**
     * O segundo dígito deve ser > 6;
     */
    public function testSecundNumberMustBeGreaterThanSix()
    {
        $phone = '990171628';

        $this->rule = new SecondDigitGreaterThan(6);

        $this->assertTrue($this->rule->passes('test', $phone));
    }
}
