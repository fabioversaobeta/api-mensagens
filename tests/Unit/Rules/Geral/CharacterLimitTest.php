<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;

use App\Rules\Geral\CharacterLimit;

class CharacterLimitTest extends TestCase
{
    protected $suitableService;

    public function setUp() : void
    {
        // $this->suitableService = new SuitableMessagesService();
    }

    /**
     * as mensagens com mais de 140 caracteres deverão ser bloqueadas;
     *
     * @return void
     */
    public function testMessagesWithMoreThan140CharactersMustBeBlockedTest()
    {
        $msg = 'sit amet eros suspendisse accumsan tortor quis turpis sed ante sit amet eros suspendisse accumsan tortor quis turpis sed ante sit amet eros suspendisse accumsan tortor quis turpis sed ante';

        $this->rule = new CharacterLimit(140);

        $this->assertFalse($this->rule->passes('test', $msg));
    }

    /**
     * as mensagens com menos de 140 caracteres deverão ser liberadas;
     *
     * @return void
     */
    public function testMessagesWithLessThan140CharactersTest()
    {
        $msg = 'tortor quis turpis sed ante sit amet eros suspendisse accumsan tortor quis turpis sed ante';

        $this->rule = new CharacterLimit(140);

        $this->assertTrue($this->rule->passes('test', $msg));
    }
}
