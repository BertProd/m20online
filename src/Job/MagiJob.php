<?php
/**
 * Call Job to avoid confusion with "classes"
 * 
 * @author Bertrand Andres <bertrand.andres.dev@gmail.com>
 */

namespace M20Online\Job;

use M20Online\Entity\ArmorEntity;
use M20Online\Entity\CharacterEntity;

final class MagiJob extends JobAbstract
{
    /**
     * Magi have theses bonuses:
     * +3 to Knowledge.
     */
    public function applyBonus (CharacterEntity $pCharacterEntity) : void
    {
        $pCharacterEntity->addBonus(CharacterEntity::SKILL_KNOWLEDGE, 3);
    }

    public function canEquipArmor (ArmorEntity $pArmorEntity) : bool
    {
        return false;
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
