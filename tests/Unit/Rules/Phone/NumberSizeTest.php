<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;

use App\Rules\Phone\NumberSize;

class NumberSizeTest extends TestCase
{
    protected $suitableService;

    public function setUp() : void
    {
        // $this->suitableService = new SuitableMessagesService();
    }

    /**
     * Se Número do celular não conter 9 dígitos será bloqueado;
     *
     * @return void
     */
    public function testPhoneNumberNotContainNineDigitsAsBlocked()
    {
        $phone = '99017168';

        $this->rule = new NumberSize(9);

        $this->assertFalse($this->rule->passes('test', $phone));
    }

    /**
     * Número do celular deve conter 9 dígitos;
     *
     * @return void
     */
    public function testPhoneNumberMustContainNineDigits()
    {
        $phone = '990171628';

        $this->rule = new NumberSize(9);

        $this->assertTrue($this->rule->passes('test', $phone));
    }
}
