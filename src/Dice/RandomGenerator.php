<?php

namespace M20OnlineCore\Dice;

final class RandomGenerator implements RandomGeneratorInterface
{
    public function rollNumberBetween(int $pMin, int $pMax) : int
    {
        return random_int($pMin, $pMax);
    }
}
