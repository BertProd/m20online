<?php
namespace M20Online\Dice;

interface DiceInterface
{
    public function __construct(RandomGeneratorInterface $pRandomGenerator);

    public function roll() : int;
}