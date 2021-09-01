<?php

use M20Online\Entity\CharacterEntity;
use M20Online\Race\ElfRace;
use PHPUnit\Framework\TestCase;

final class ElfRaceTest extends TestCase
{
    public function testApplyBonus()
    {
        $stats = [CharacterEntity::STAT_DEX, CharacterEntity::STAT_MIND, CharacterEntity::STAT_STR];
        
        $skills = [
            CharacterEntity::SKILL_COMMUNICATION,
            CharacterEntity::SKILL_KNOWLEDGE,
            CharacterEntity::SKILL_PHYSICAL,
            CharacterEntity::SKILL_SUBTERFUGE
        ];

        $characterEntity = new CharacterEntity([]);

        foreach ($stats as $stat) {
            $characterEntity->setStatBonus($stat, 0);
        }
        
        foreach ($skills as $skill) {
            $characterEntity->setSkillBonus($skill, 0);
        }

        $elfRace = new ElfRace();
        $elfRace->applyBonus($characterEntity);

        $this->assertSame(0, $characterEntity->getStatBonus(CharacterEntity::STAT_DEX));
        $this->assertSame(2, $characterEntity->getStatBonus(CharacterEntity::STAT_MIND));
        $this->assertSame(0, $characterEntity->getStatBonus(CharacterEntity::STAT_STR));

        foreach ($skills as $skill) {
            $this->assertSame(0, $characterEntity->getSkillBonus($skill));
        }
    }
}
