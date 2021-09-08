<?php

namespace M20Online\Job;

use M20Online\Entity\ArmorEntity;
use M20Online\Entity\CharacterEntity;

final class ClericJob extends JobAbstract
{
    const NAME = 'cleric';
    
    public function applyBonus (CharacterEntity $pCharacterEntity) : void
    {
        $pCharacterEntity->addBonus(CharacterEntity::SKILL_COMMUNICATION, 3);
    }

    public function canEquipArmor (ArmorEntity $pArmorEntity) : bool
    {
        return $pArmorEntity->isLower() || $pArmorEntity->isMedium();
    }

    public function canEquipShield () : bool
    {
        return false;
    }

    public function canCastSpell () : bool
    {
        return true;
    }
}
