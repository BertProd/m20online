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

        $elfRace = new ElfRace();
        $elfRace->applyBonus($characterEntity);

        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_DEX));
        $this->assertSame(2, $characterEntity->getBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_MIND));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_STR));

        foreach ($skills as $skill) {
            $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::BONUS_SKILL, $skill));
        }
    }
}
