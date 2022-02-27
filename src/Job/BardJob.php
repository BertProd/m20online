<?php

/**
 * According to microlite20 rules, bards get following bonuses:
 *  +2 in communication
 *  +2 in knowledge
 *  +2 in subterfuge
 *
 * - They wear light armor
 * - They can use shields
 * - At level 6, they become able to cast spells
 * 
 * @author Bertrand Andres
 */

namespace M20OnlineCore\Job;

use M20OnlineCore\Entity\ArmorEntity;
use M20OnlineCore\Entity\CharacterEntity;

final class BardJob extends JobAbstract
{
    public const NAME = 'bard';

    public function applyBonus(CharacterEntity $pCharacterEntity): void
    {
        $pCharacterEntity->addBonus(CharacterEntity::SKILL_COMMUNICATION, 2);
        $pCharacterEntity->addBonus(CharacterEntity::SKILL_KNOWLEDGE, 2);
        $pCharacterEntity->addBonus(CharacterEntity::SKILL_SUBTERFUGE, 2);
    }

    public function canEquipArmor(ArmorEntity $pArmorEntity): bool
    {
        return $pArmorEntity->isLower();
    }

    public function canEquipShield(): bool
    {
        return true;
    }

    /**
     * @TODO: cast spell only at level 6 and more
     */
    public function canCastSpell(): bool
    {
        return true;
    }
}
