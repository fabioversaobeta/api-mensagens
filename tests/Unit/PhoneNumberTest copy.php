<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PhoneNumberTest extends TestCase
{
    /**
     * DDD com 2 dígitos
     *
     * @return void
     */
    public function dddWithTwoDigitsTest()
    {
        $ddd = 41;

        $this->assertEquals(2, strlen($ddd));
    }

    /**
     * DDD deve ser válido
     *
     * @return void
     */
    public function dddMustBeValidTest()
    {
        $listDDD = [
            11,12,13,14,15,16,17,18,19,21,22,24,27,28,31,32,33,34,35,37,38,
            41,42,43,44,45,46,47,48,49,51,53,54,55,61,62,63,64,65,66,67,68,
            69,71,73,74,75,77,79,81,82,83,84,85,86,87,88,89,91,92,93,94,95,
            96,97,98,99
        ];

        $ddd = 41;

        $this->assertContains($ddd, $listDDD);

        $ddd = 01;

        $this->assertNotContains($ddd, $listDDD);
    }

    /**
     * Número do celular deve conter 9 dígitos;
     *
     * @return void
     */
    public function phoneNumberMustContainNineDigitsTest()
    {
        // Contém 9 dígitos

        $phone = 41984395789;

        $number = substr($phone, 2);

        $this->assertEquals(9, strlen($number));

        // Não contém 9 dígitos

        $phone = 4184395789;

        $number = substr($phone, 2);

        $this->assertNotEquals(9, strlen($number));
    }

    /**
     * Número do celular deve começar com 9;
     */
    public function phoneNumberMusteStartWithNineTest()
    {
        // Inicia com 9

        $phone = 41984395789;

        $number = substr($phone, 2);

        $digit = substr($number, 0, 1);

        $this->assertEquals(9, $digit);

        // Não inicia com 9

        $phone = 4184395789;

        $number = substr($phone, 2);

        $digit = substr($number, 0, 1);

        $this->assertEquals(9, $digit);
    }

    /**
     * O segundo dígito deve ser > 6;
     */
    public function secundNumberMustBeGreaterThanSixTest()
    {
        $phone = 41984395789;

        $second = substr($phone, 3, 1);

        $this->assertGreaterThan(6, $second);
    }
}
