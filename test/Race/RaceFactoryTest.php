<?php

namespace M20Online\Race;

use InvalidArgumentException;
use LogicException;
use M20Online\Race\HumanRace;
use M20Online\Race\RaceFactory;
use PHPUnit\Framework\TestCase;

final class NointerfaceRace
{
    //
}

final class RaceFactoryTest extends TestCase
{
    public function testFactory()
    {
        $raceFactory = new RaceFactory();

        $humanRace = $raceFactory->factory('dwarf');
        $this->assertInstanceOf('M20Online\Race\DwarfRace', $humanRace);

        $humanRace = $raceFactory->factory('elf');
        $this->assertInstanceOf('M20Online\Race\ElfRace', $humanRace);

        $humanRace = $raceFactory->factory('halfling');
        $this->assertInstanceOf('M20Online\Race\HalflingRace', $humanRace);

        $humanRace = $raceFactory->factory('human');
        $this->assertInstanceOf('M20Online\Race\HumanRace', $humanRace);
    }

    public function testFactoryNonExistingRace()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Race nonexist (M20Online\Race\NonexistRace) not found');
        
        $raceFactory = new RaceFactory();

        $raceFactory->factory('nonexist');
    }

    public function testFactoryRaceWithoutInterface()
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Race nointerface does not implement RaceInterface');

        $raceFactory = new RaceFactory();

        $raceFactory->factory('nointerface');
    }
}
