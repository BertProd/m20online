<?php

namespace M20Online\Job;

use InvalidArgumentException;
use LogicException;
use M20Online\Job\JobFactory;
use PHPUnit\Framework\TestCase;

final class NointerfaceJob
{
    //
}

final class JobFactoryTest extends TestCase
{
    public function testFactory()
    {
        $jobFactory = new JobFactory();

        $res = $jobFactory->factory('cleric');
        $this->assertInstanceOf('M20Online\Job\ClericJob', $res);

        $res = $jobFactory->factory('fighter');
        $this->assertInstanceOf('M20Online\Job\FighterJob', $res);

        $res = $jobFactory->factory('magi');
        $this->assertInstanceOf('M20Online\Job\MagiJob', $res);

        $res = $jobFactory->factory('rogue');
        $this->assertInstanceOf('M20Online\Job\RogueJob', $res);
    }

    public function testFactoryWithNonExistingJob ()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Job nonexist (M20Online\Job\NonexistJob) not found');

        $jobFactory = new JobFactory();

        $jobFactory->factory('nonexist');
    }

    public function testFactoryJobWithNoInterface ()
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Job nointerface does not implement JobInterface');

        $jobFactory = new JobFactory();

        $jobFactory->factory('nointerface');
    }
}

