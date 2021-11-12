<?php

use M20OnlineCore\Race\DwarfRace;
use M20OnlineCore\Race\ElfRace;
use M20OnlineCore\Race\HalflingRace;
use M20OnlineCore\Race\HumanRace;
use M20OnlineCore\Race\RaceIterator;
use PHPUnit\Framework\TestCase;


final class RaceIteratorTest extends TestCase
{
    public function testValues () : void
    {
        $raceIterator = new RaceIterator();

        $checkedDwarf = false;
        $checkedElf = false;
        $checkedHalfling = false;
        $checkedHuman = false;

        foreach ($raceIterator as $key => $job) {
            if (0 === $key) {
                $this->assertSame(DwarfRace::NAME, $job);
                $checkedDwarf = true;
            }
            else if (1 === $key) {
                $this->assertSame(ElfRace::NAME, $job);
                $checkedElf = true;
            }
            else if (2 === $key) {
                $this->assertSame(HalflingRace::NAME, $job);
                $checkedHalfling = true;
            }
            else if (3 === $key) {
                $this->assertSame(HumanRace::NAME, $job);
                $checkedHuman = true;
            }
        }

        $this->assertTrue($checkedDwarf);
        $this->assertTrue($checkedElf);
        $this->assertTrue($checkedHalfling);
        $this->assertTrue($checkedHuman);
    }
}

