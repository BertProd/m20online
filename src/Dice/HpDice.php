<?php
namespace M20Online\Dice;

use LogicException;

final class HpDice implements DiceInterface
{
    private RandomGeneratorInterface $randomGenerator;

    public function __construct(RandomGeneratorInterface $pRandomGenerator)
    {
        $this->randomGenerator = $pRandomGenerator;
    }

    public function roll() : int
    {
        return $this->randomGenerator->rollNumberBetween(1, 6);
    }
}
