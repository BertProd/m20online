<?php

namespace M20Online\Dice;

final class RandomGenerator implements RandomGeneratorInterface
{
    public function rollNumberBetween(int $pMin, int $pMax) : int
    {
        return random_int($pMin, $pMax);
    }
}
