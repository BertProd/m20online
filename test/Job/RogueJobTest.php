<?php

use M20Online\Entity\ArmorEntity;
use M20Online\Entity\CharacterEntity;
use M20Online\Job\RogueJob;
use PHPUnit\Framework\TestCase;

final class RogueJobTest extends TestCase
{
    public function testApplyBonus ()
    {
        $characterEntity = new CharacterEntity([]);

        (new RogueJob())->applyBonus($characterEntity);

        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
    }
    
    public function testApplyLevelBonus ()
    {
        $characterEntity = new CharacterEntity([]);

        $rogueJob = new RogueJob([]);

        for ($i = 1; $i <= 5; $i++) {
            $characterEntity->set(CharacterEntity::FIELD_LEVEL, $i);
            $rogueJob->applyLevelBonus($characterEntity);
        }

        $rogueJob->applyLevelBonus($characterEntity);

        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testCanEquipArmor ()
    {
        $armorEntity = new ArmorEntity(['kind' => ArmorEntity::LOWER_ARMOR]);

        $rogueJob = new RogueJob();

        $this->assertTrue($rogueJob->canEquipArmor($armorEntity));

        $armorEntity->set('kind', ArmorEntity::MEDIUM_ARMOR);
        $this->assertFalse($rogueJob->canEquipArmor($armorEntity));
        
        $armorEntity->set('kind', ArmorEntity::HEAVY_ARMOR);
        $this->assertFalse($rogueJob->canEquipArmor($armorEntity));
    }

    public function testCanEquipShield ()
    {
        $this->assertFalse((new RogueJob())->canEquipShield());
    }

    public function testCanCastSpell ()
    {
        $this->assertFalse((new RogueJob())->canCastSpell());
    }
}