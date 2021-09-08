<?php
namespace M20OnlineCore\Dice;

interface DiceInterface
{
    public function __construct(RandomGeneratorInterface $pRandomGenerator);

    public function roll() : int;
}