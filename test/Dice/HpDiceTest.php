<?php

use PHPUnit\Framework\TestCase;

use M20OnlineCore\Dice\RandomGeneratorInterface;
use M20OnlineCore\Dice\HpDice;

final class M20MockRandomGeneratorHp implements RandomGeneratorInterface
{
    public function rollNumberBetween(int $pMin, int $pMax) : int
    {
        return 6;
    }
}

final class HpDiceTest extends TestCase
{
    public function testRoll ()
    {
        $randomGenerator = new M20MockRandomGeneratorHp();

        $hpDice = new HpDice($randomGenerator);
        $this->assertSame(6, $hpDice->roll());
    }
}