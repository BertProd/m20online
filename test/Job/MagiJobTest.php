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

    public function testCanEquipArmor ()
    {
        $armorEntity = new ArmorEntity(['kind' => ArmorEntity::LOWER_ARMOR]);

        $magiJob = new MagiJob();

        $this->assertFalse($magiJob->canEquipArmor($armorEntity));

        $armorEntity->set('kind', ArmorEntity::MEDIUM_ARMOR);
        $this->assertFalse($magiJob->canEquipArmor($armorEntity));
        
        $armorEntity->set('kind', ArmorEntity::HEAVY_ARMOR);
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
