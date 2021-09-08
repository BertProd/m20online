<?php

use M20Online\Entity\ArmorEntity;
use M20Online\Entity\CharacterEntity;
use M20Online\Job\MagiJob;
use PHPUnit\Framework\TestCase;

final class MagiJobTest extends TestCase
{
    public function testApplyBonus ()
    {
        $characterEntity = new CharacterEntity([]);

        (new MagiJob())->applyBonus($characterEntity);

        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
    }
    
    public function testApplyLevelBonus ()
    {
        $characterEntity = new CharacterEntity([]);

        $magiJob = new MagiJob([]);

        for ($i = 1; $i <= 5; $i++) {
            $characterEntity->set(CharacterEntity::FIELD_LEVEL, $i);
            $magiJob->applyLevelBonus($characterEntity);
        }

        $magiJob->applyLevelBonus($characterEntity);

        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testCanEquipArmor ()
    {
        $armorEntity = new ArmorEntity([ArmorEntity::FIELD_KIND => ArmorEntity::KIND_LOWER_ARMOR]);

        $magiJob = new MagiJob();

        $this->assertFalse($magiJob->canEquipArmor($armorEntity));

        $armorEntity->set(ArmorEntity::FIELD_KIND, ArmorEntity::KIND_MEDIUM_ARMOR);
        $this->assertFalse($magiJob->canEquipArmor($armorEntity));
        
        $armorEntity->set(ArmorEntity::FIELD_KIND, ArmorEntity::KIND_HEAVY_ARMOR);
        $this->assertFalse($magiJob->canEquipArmor($armorEntity));
    }

    public function testCanEquipShield ()
    {
        $this->assertFalse((new MagiJob())->canEquipShield());
    }

    public function testCanCastSpell ()
    {
        $this->assertTrue((new MagiJob())->canCastSpell());
    }
}
