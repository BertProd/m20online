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

        $humanRace = new HumanRace();
        $humanRace->applyBonus($characterEntity);

        foreach ($skills as $skill) {
            $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::BONUS_SKILL, $skill));
        }

        foreach ($stats as $stat) {
            $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::BONUS_STAT, $stat));
        }
    }
}
