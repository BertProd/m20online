<?php

use M20OnlineCore\Job\ClericJob;
use M20OnlineCore\Job\FighterJob;
use M20OnlineCore\Job\JobIterator;
use M20OnlineCore\Job\MagiJob;
use M20OnlineCore\Job\RogueJob;
use PHPUnit\Framework\TestCase;

final class JobIteratorTest extends TestCase
{
    public function testValues () : void
    {
        $jobIterator = new JobIterator();

        $checkedCleric = false;
        $checkedFighter = false;
        $checkedMagi = false;
        $checkedRogue = false;

        foreach ($jobIterator as $key => $job) {
            if (0 === $key) {
                $this->assertSame(ClericJob::NAME, $job);
                $checkedCleric = true;
            }
            else if (1 === $key) {
                $this->assertSame(FighterJob::NAME, $job);
                $checkedFighter = true;
            }
            else if (2 === $key) {
                $this->assertSame(MagiJob::NAME, $job);
                $checkedMagi = true;
            }
            else if (3 === $key) {
                $this->assertSame(RogueJob::NAME, $job);
                $checkedRogue = true;
            }
        }

        $this->assertTrue($checkedCleric);
        $this->assertTrue($checkedFighter);
        $this->assertTrue($checkedMagi);
        $this->assertTrue($checkedRogue);
    }
}
