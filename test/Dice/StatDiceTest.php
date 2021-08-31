<?php

use PHPUnit\Framework\TestCase;

use M20Online\Dice\RandomGeneratorInterface;
use M20Online\Dice\StatDice;

final class M20MockRandomGeneratorStat implements RandomGeneratorInterface
{
    public function rollNumberBetween(int $pMin, int $pMax) : int
    {
        return 5;
    }
}

final class StatDiceTest extends TestCase
{
    public function testRoll ()
    {
        $randomGenerator = new M20MockRandomGeneratorStat();

        $statDice = new StatDice($randomGenerator);
        $this->assertSame(15, $statDice->roll());
    }
}