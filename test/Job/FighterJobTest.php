<?php

use M20OnlineCore\Entity\ArmorEntity;
use M20OnlineCore\Entity\CharacterEntity;
use M20OnlineCore\Job\FighterJob;
use PHPUnit\Framework\TestCase;

final class FighterJobTest extends TestCase
{
    public function testApplyBonus ()
    {
        $characterEntity = new CharacterEntity([
            CharacterEntity::FIELD_LEVEL => 1
        ]);

        $fighterJob = new FighterJob([]);

        $fighterJob->applyBonus($characterEntity);

        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));

        $characterEntity = new CharacterEntity([
            CharacterEntity::FIELD_LEVEL => 5
        ]);
        
        $fighterJob->applyBonus($characterEntity);

        $this->assertSame(4, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(2, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(2, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));

        $characterEntity = new CharacterEntity([
            CharacterEntity::FIELD_LEVEL => 10
        ]);
        
        $fighterJob->applyBonus($characterEntity);

        $this->assertSame(5, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testApplyLevelBonus ()
    {
        $characterEntity = new CharacterEntity([
            CharacterEntity::FIELD_LEVEL => 1
        ]);

        $fighterJob = new FighterJob([]);

        $fighterJob->applyLevelBonus($characterEntity);

        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(0, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));

        for ($i = 1; $i <= 5; $i++) {
            $characterEntity->set(CharacterEntity::FIELD_LEVEL, $i);
            $fighterJob->applyLevelBonus($characterEntity);
        }

        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));

        for ($i = 6; $i <= 10; $i++) {
            $characterEntity->set(CharacterEntity::FIELD_LEVEL, $i);
            $fighterJob->applyLevelBonus($characterEntity);
        }

        $this->assertSame(2, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(2, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(2, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));

        for ($i = 11; $i <= 15; $i++) {
            $characterEntity->set(CharacterEntity::FIELD_LEVEL, $i);
            $fighterJob->applyLevelBonus($characterEntity);
        }

        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));

        for ($i = 16; $i <= 20; $i++) {
            $characterEntity->set(CharacterEntity::FIELD_LEVEL, $i);
            $fighterJob->applyLevelBonus($characterEntity);
        }

        $this->assertSame(4, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(4, $characterEntity->getBonus(CharacterEntity::COMBAT_ATTACK));
        $this->assertSame(4, $characterEntity->getBonus(CharacterEntity::COMBAT_DAMAGE));
    }

    public function testCanEquipArmor()
    {
        $armorEntity = new ArmorEntity([ArmorEntity::FIELD_KIND => ArmorEntity::KIND_LOWER_ARMOR]);

        $fighterJob = new FighterJob();

        $this->assertTrue($fighterJob->canEquipArmor($armorEntity));

        $armorEntity->set(ArmorEntity::FIELD_KIND, ArmorEntity::KIND_MEDIUM_ARMOR);
        $this->assertTrue($fighterJob->canEquipArmor($armorEntity));
        
        $armorEntity->set(ArmorEntity::FIELD_KIND, ArmorEntity::KIND_HEAVY_ARMOR);
        $this->assertTrue($fighterJob->canEquipArmor($armorEntity));
    }

    public function testCanEquipShield ()
    {
        $this->assertTrue((new FighterJob())->canEquipShield());
    }

    public function testCanCastSpell ()
    {
        $this->assertFalse((new FighterJob())->canCastSpell());
    }
}
