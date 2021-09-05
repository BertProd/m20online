<?php

use M20Online\Dice\RandomGenerator;
use PHPUnit\Framework\TestCase;

final class RandomGeneratorTest extends TestCase
{
    public function testRollNumberBetween()
    {
        $min = 1;
        $max = 6;

        $randomGenerator = new RandomGenerator();

        for ($i = 0; $i < 1000; $i++) {
            $res = $randomGenerator->rollNumberBetween($min, $max);

            $this->assertGreaterThanOrEqual($min, $res);
            $this->assertLessThanOrEqual($max, $res);
        }
    }
} 