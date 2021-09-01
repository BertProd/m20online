<?php

use M20Online\Entity\CharacterEntity;
use M20Online\Race\HumanRace;
use PHPUnit\Framework\TestCase;

final class HumanRaceTest extends TestCase
{
    public function testApplyBonus ()
    {
        $skills = [
            CharacterEntity::SKILL_COMMUNICATION,
            CharacterEntity::SKILL_KNOWLEDGE,
            CharacterEntity::SKILL_PHYSICAL,
            CharacterEntity::SKILL_SUBTERFUGE
        ];
        
        $stats = [CharacterEntity::STAT_DEX, CharacterEntity::STAT_MIND, CharacterEntity::STAT_STR];

        $characterEntity = new CharacterEntity([]);

        foreach ($skills as $skill) {
            $characterEntity->setSkillBonus($skill, 0);
        }

        foreach ($stats as $stat) {
            $characterEntity->setStatBonus($stat, 0);
        }

        $humanRace = new HumanRace();
        $humanRace->applyBonus($characterEntity);

        foreach ($skills as $skill) {
            $this->assertSame(1, $characterEntity->getSkillBonus($skill));
        }

        foreach ($stats as $stat) {
            $this->assertSame(0, $characterEntity->getStatBonus($stat));
        }
    }
}
