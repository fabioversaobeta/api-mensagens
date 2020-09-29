<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;

use App\Rules\Phone\ValidDDD;

class ValidDDDTest extends TestCase
{
    protected $suitableService;

    public function setUp() : void
    {
        // $this->suitableService = new SuitableMessagesService();
    }

    /**
     * DDD deve ser válido ou será bloqueado
     *
     * @return void
     */
    public function testDddMustBeValidOrHasBlocked()
    {
        $ddd = '70';

        $this->rule = new ValidDDD();

        $this->assertFalse($this->rule->passes('test', $ddd));
    }

    /**
     * DDD deve ser válido ou será bloqueado
     *
     * @return void
     */
    public function testDddMustBeValid()
    {
        $ddd = '41';

        $this->rule = new ValidDDD();

        $this->assertTrue($this->rule->passes('test', $ddd));
    }
}
