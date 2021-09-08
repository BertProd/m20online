<?php
namespace M20OnlineCore\Dice;

interface RandomGeneratorInterface
{
    public function rollNumberBetween(int $pMin, int $pMax) : int;
}
