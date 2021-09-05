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

    public function testCanEquipArmor ()
    {
        $armorEntity = new ArmorEntity([
            'kind' => ArmorEntity::LOWER_ARMOR
        ]);

        $clericJob = new ClericJob();

        $this->assertTrue($clericJob->canEquipArmor($armorEntity));

        $armorEntity->set('kind', ArmorEntity::MEDIUM_ARMOR);
        $this->assertTrue($clericJob->canEquipArmor($armorEntity));
        
        $armorEntity->set('kind', ArmorEntity::HEAVY_ARMOR);
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
