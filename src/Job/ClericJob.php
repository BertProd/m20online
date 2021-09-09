<?php

namespace M20OnlineCore\Job;

use M20OnlineCore\Entity\ArmorEntity;
use M20OnlineCore\Entity\CharacterEntity;

final class ClericJob extends JobAbstract
{
    public const NAME = 'cleric';

    public function applyBonus(CharacterEntity $pCharacterEntity): void
    {
        $pCharacterEntity->addBonus(CharacterEntity::SKILL_COMMUNICATION, 3);
    }

    public function canEquipArmor(ArmorEntity $pArmorEntity): bool
    {
        return $pArmorEntity->isLower() || $pArmorEntity->isMedium();
    }

    public function canEquipShield(): bool
    {
        return false;
    }

    public function canCastSpell(): bool
    {
        return true;
    }
}
