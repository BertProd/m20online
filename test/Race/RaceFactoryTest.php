<?php

namespace M20OnlineCore\Race;

use InvalidArgumentException;
use LogicException;
use M20OnlineCore\Race\DwarfRace;
use M20OnlineCore\Race\ElfRace;
use M20OnlineCore\Race\HalflingRace;
use M20OnlineCore\Race\HumanRace;
use M20OnlineCore\Race\RaceFactory;
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

        $res = $raceFactory->factory(DwarfRace::NAME);
        $this->assertInstanceOf(DwarfRace::class, $res);

        $res = $raceFactory->factory(ElfRace::NAME);
        $this->assertInstanceOf(ElfRace::class, $res);

        $res = $raceFactory->factory(HalflingRace::NAME);
        $this->assertInstanceOf(HalflingRace::class, $res);

        $res = $raceFactory->factory(HumanRace::NAME);
        $this->assertInstanceOf(HumanRace::class, $res);
    }

    public function testFactoryNonExistingRace()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Race nonexist (M20OnlineCore\Race\NonexistRace) not found');
        
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
