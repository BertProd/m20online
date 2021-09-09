<?php

namespace M20OnlineCore\Dice;

final class StatDice extends DiceAbstract
{
    private RandomGeneratorInterface $randomGenerator;

    public function __construct(RandomGeneratorInterface $pRandomGenerator)
    {
        $this->randomGenerator = $pRandomGenerator;
    }

    public function roll(): int
    {
        $resultsList = [];

        // Generate values
        for ($i = 0; $i < 4; $i++) {
            $resultsList[] = $this->randomGenerator->rollNumberBetween(1, 6);
        }

        // Drop lowest value
        sort($resultsList);
        array_shift($resultsList);

        // Sum remaining values and return it:
        return array_sum($resultsList);
    }
}
