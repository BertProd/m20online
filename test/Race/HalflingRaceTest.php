<?php

use M20Online\Entity\CharacterEntity;
use M20Online\Race\HalflingRace;
use PHPUnit\Framework\TestCase;

final class HalflingRaceTest extends TestCase
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

        $halflingRace = new HalflingRace();
        $halflingRace->applyBonus($characterEntity);

        $this->assertSame(2, $characterEntity->getBonus(CharacterEntity::STAT_DEX));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::STAT_MIND));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::STAT_STR));

        foreach ($skills as $skill) {
            $this->assertSame(0, $characterEntity->getBonus($skill));
        }
    }
}
