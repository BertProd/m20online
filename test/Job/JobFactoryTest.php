<?php

namespace M20Online\Job;

use InvalidArgumentException;
use LogicException;
use M20Online\Job\ClericJob;
use M20Online\Job\FighterJob;
use M20Online\Job\JobFactory;
use M20Online\Job\MagiJob;
use M20Online\Job\RogueJob;
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

        $res = $jobFactory->factory(ClericJob::NAME);
        $this->assertInstanceOf(ClericJob::class, $res);

        $res = $jobFactory->factory(FighterJob::NAME);
        $this->assertInstanceOf(FighterJob::class, $res);

        $res = $jobFactory->factory(MagiJob::NAME);
        $this->assertInstanceOf(MagiJob::class, $res);

        $res = $jobFactory->factory(RogueJob::NAME);
        $this->assertInstanceOf(RogueJob::class, $res);
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

