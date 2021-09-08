<?php

use M20Online\Builder\CharacterBuilder;
use M20Online\Entity\CharacterEntity;
use M20Online\Job\ClericJob;
use M20Online\Job\FighterJob;
use M20Online\Job\MagiJob;
use M20Online\Job\RogueJob;
use M20Online\Race\DwarfRace;
use M20Online\Race\ElfRace;
use M20Online\Race\HalflingRace;
use M20Online\Race\HumanRace;
use PHPUnit\Framework\TestCase;

final class CharacterBuilderTest extends TestCase
{
    private CharacterBuilder $characterBuilder;

    protected function setUp() : void
    {
        $this->characterBuilder = new CharacterBuilder();
    }

    private function checkWhatIsCommon (CharacterEntity $pCharacterEntity, string $pRace, string $pJob) : void
    {
        // Check basic data
        $this->assertSame(1, $pCharacterEntity->get(CharacterEntity::FIELD_LEVEL));
        $this->assertSame($pRace, $pCharacterEntity->get(CharacterEntity::FIELD_RACE));
        $this->assertSame($pJob, $pCharacterEntity->get(CharacterEntity::FIELD_JOB));

        // Check stats values:
        $stats = [
            $pCharacterEntity->get(CharacterEntity::STAT_DEX),
            $pCharacterEntity->get(CharacterEntity::STAT_MIND),
            $pCharacterEntity->get(CharacterEntity::STAT_STR)
        ];

        foreach ($stats as $stat) {
            $this->assertGreaterThanOrEqual(3, $stat);
            $this->assertLessThanOrEqual(18, $stat);
        }

        $statsList = [
            CharacterEntity::STAT_DEX,
            CharacterEntity::STAT_MIND,
            CharacterEntity::STAT_STR
        ];

        foreach ($statsList as $stat) {
            $statBonusValue = $this->getStatBonusValue($pRace, $stat, $pCharacterEntity->get($stat));
            $this->assertSame($statBonusValue, $pCharacterEntity->getBonus($stat));
        }


        $hp = $pCharacterEntity->get(CharacterEntity::FIELD_HP);
        $statStr = $pCharacterEntity->get(CharacterEntity::STAT_STR);
        $bonusStr = $pCharacterEntity->getBonus(CharacterEntity::STAT_STR);

        $this->assertGreaterThanOrEqual($statStr + $bonusStr + 1, $hp);
        $this->assertLessThanOrEqual($statStr + $bonusStr + 6, $hp);
    }

    private function getStatBonusValue (string $pRace, string $pStat, int $pValue) : int
    {
        $bonus = floor(($pValue - 10) / 2);

        if (0 > $bonus) {
            $bonus = 0;
        }

        if (DwarfRace::NAME === $pRace && CharacterEntity::STAT_STR === $pStat) {
            $bonus += 2;
        }
        else if (ElfRace::NAME === $pRace && CharacterEntity::STAT_MIND === $pStat) {
            $bonus += 2;
        }
        else if (HalflingRace::NAME === $pRace && CharacterEntity::STAT_DEX === $pStat) {
            $bonus += 2;
        }

        return $bonus;
    }

    public function testBuildDwarfCleric ()
    {
        $race = DwarfRace::NAME;
        $job = ClericJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildDwarfFighter ()
    {
        $race = DwarfRace::NAME;
        $job = FighterJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildDwarfMagi ()
    {
        $race = DwarfRace::NAME;
        $job = MagiJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildDwarfRogue ()
    {
        $race = DwarfRace::NAME;
        $job = RogueJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildElfCleric()
    {
        $race = ElfRace::NAME;
        $job = ClericJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildElfFighter()
    {
        $race = ElfRace::NAME;
        $job = FighterJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildElfMagi()
    {
        $race = ElfRace::NAME;
        $job = MagiJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildElfRogue()
    {
        $race = ElfRace::NAME;
        $job = RogueJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildHalflingCleric()
    {
        $race = HalflingRace::NAME;
        $job = ClericJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildHalflingFighter()
    {
        $race = HalflingRace::NAME;
        $job = FighterJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildHalflingMagi()
    {
        $race = HalflingRace::NAME;
        $job = MagiJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildHalflingRogue()
    {
        $race = HalflingRace::NAME;
        $job = RogueJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildHumanCleric()
    {
        $race = HumanRace::NAME;
        $job = ClericJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);
        
        $this->assertSame(4, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildHumanFighter()
    {
        $race = HumanRace::NAME;
        $job = FighterJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);

        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(4, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildHumanMagi ()
    {
        $race = HumanRace::NAME;
        $job = MagiJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);

        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(4, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testBuildHumanRogue ()
    {
        $race = HumanRace::NAME;
        $job = RogueJob::NAME;

        $characterEntity = $this->characterBuilder->build($race, $job);

        $this->checkWhatIsCommon($characterEntity, $race, $job);

        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(4, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }
}
