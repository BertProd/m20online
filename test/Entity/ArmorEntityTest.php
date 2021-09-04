<?php

use M20Online\Entity\ArmorEntity;
use PHPUnit\Framework\TestCase;

final class ArmorEntityTest extends TestCase
{
    public function testLowerArmor ()
    {
        $armorEntity = new ArmorEntity([
            'kind' => ArmorEntity::LOWER_ARMOR
        ]);

        $this->assertTrue($armorEntity->isLower());
        $this->assertFalse($armorEntity->isMedium());
        $this->assertFalse($armorEntity->isHeavy());
    }
    
    public function testMediumArmor ()
    {
        $armorEntity = new ArmorEntity([
            'kind' => ArmorEntity::MEDIUM_ARMOR
        ]);

        $this->assertFalse($armorEntity->isLower());
        $this->assertTrue($armorEntity->isMedium());
        $this->assertFalse($armorEntity->isHeavy());
    }
    
    public function testHeavyArmor ()
    {
        $armorEntity = new ArmorEntity([
            'kind' => ArmorEntity::HEAVY_ARMOR
        ]);

        $this->assertFalse($armorEntity->isLower());
        $this->assertFalse($armorEntity->isMedium());
        $this->assertTrue($armorEntity->isHeavy());
    }
}
