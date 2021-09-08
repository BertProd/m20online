<?php

use M20OnlineCore\Entity\CharacterEntity;
use M20OnlineCore\Race\DwarfRace;
use PHPUnit\Framework\TestCase;

final class DwarfRaceTest extends TestCase
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

        $dwarfRace = new DwarfRace();
        $dwarfRace->applyBonus($characterEntity);

        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::STAT_DEX));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::STAT_MIND));
        $this->assertSame(2, $characterEntity->getBonus(CharacterEntity::STAT_STR));

        foreach ($skills as $skill) {
            $this->assertSame(0, $characterEntity->getBonus($skill));
        }
    }
}
