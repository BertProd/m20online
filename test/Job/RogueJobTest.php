<?php

use M20OnlineCore\Entity\ArmorEntity;
use M20OnlineCore\Entity\CharacterEntity;
use M20OnlineCore\Job\RogueJob;
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
        $armorEntity = new ArmorEntity([ArmorEntity::FIELD_KIND => ArmorEntity::KIND_LOWER_ARMOR]);

        $rogueJob = new RogueJob();

        $this->assertTrue($rogueJob->canEquipArmor($armorEntity));

        $armorEntity->set(ArmorEntity::FIELD_KIND, ArmorEntity::KIND_MEDIUM_ARMOR);
        $this->assertFalse($rogueJob->canEquipArmor($armorEntity));
        
        $armorEntity->set(ArmorEntity::FIELD_KIND, ArmorEntity::KIND_HEAVY_ARMOR);
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