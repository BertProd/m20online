<?php

use M20Online\Entity\ArmorEntity;
use M20Online\Entity\CharacterEntity;
use M20Online\Job\ClericJob;
use PHPUnit\Framework\TestCase;

final class ClericJobTest extends TestCase
{
    public function testApplyBonus ()
    {
        $characterEntity = new CharacterEntity([]);

        (new ClericJob())->applyBonus($characterEntity);

        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
    }
    
    public function testApplyLevelBonus ()
    {
        $characterEntity = new CharacterEntity([]);

        $clericJob = new ClericJob([]);

        for ($i = 1; $i <= 5; $i++) {
            $characterEntity->set(CharacterEntity::FIELD_LEVEL, $i);
            $clericJob->applyLevelBonus($characterEntity);
        }

        $clericJob->applyLevelBonus($characterEntity);

        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testCanEquipArmor ()
    {
        $armorEntity = new ArmorEntity([
            ArmorEntity::FIELD_KIND => ArmorEntity::KIND_LOWER_ARMOR
        ]);

        $clericJob = new ClericJob();

        $this->assertTrue($clericJob->canEquipArmor($armorEntity));

        $armorEntity->set(ArmorEntity::FIELD_KIND, ArmorEntity::KIND_MEDIUM_ARMOR);
        $this->assertTrue($clericJob->canEquipArmor($armorEntity));
        
        $armorEntity->set(ArmorEntity::FIELD_KIND, ArmorEntity::KIND_HEAVY_ARMOR);
        $this->assertFalse($clericJob->canEquipArmor($armorEntity));
    }

    public function testCanEquipShield ()
    {
        $this->assertFalse((new ClericJob())->canEquipShield());
    }

    public function testCanCastSpell ()
    {
        $clericJob = new ClericJob();

        $this->assertTrue((new $clericJob())->canCastSpell());
    }
}
