<?php

/**
 * Call Job to avoid confusion with "classes"
 *
 * @author Bertrand Andres <bertrand.andres.dev@gmail.com>
 */

namespace M20OnlineCore\Job;

use M20OnlineCore\Entity\ArmorEntity;
use M20OnlineCore\Entity\CharacterEntity;

final class MagiJob extends JobAbstract
{
    public const NAME = 'magi';

    /**
     * Magi have theses bonuses:
     * +3 to Knowledge.
     */
    public function applyBonus(CharacterEntity $pCharacterEntity): void
    {
        $pCharacterEntity->addBonus(CharacterEntity::SKILL_KNOWLEDGE, 3);
    }

    public function canEquipArmor(ArmorEntity $pArmorEntity): bool
    {
        return false;
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
