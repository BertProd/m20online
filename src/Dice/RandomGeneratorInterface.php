<?php
namespace M20Online\Dice;

interface RandomGeneratorInterface
{
    public function rollNumberBetween(int $pMin, int $pMax) : int;
}
