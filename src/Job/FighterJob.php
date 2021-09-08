<?php
/**
 * Call Job to avoid confusion with "classes"
 * 
 * @author Bertrand Andres <bertrand.andres.dev@gmail.com>
 */

namespace M20Online\Job;

use M20Online\Entity\ArmorEntity;
use M20Online\Entity\CharacterEntity;

final class FighterJob extends JobAbstract
{
    const NAME = 'fighter';
    
    /**
     * Figthers have theses bonuses:
     * +3 in physical
     * +1 at attack and damage
     * For 5 levels, +1 to theses bonuses
     */
    public function applyBonus (CharacterEntity $pCharacterEntity) : void
    {
        $pCharacterEntity->addBonus(CharacterEntity::SKILL_PHYSICAL, 3);
        $pCharacterEntity->addBonus(CharacterEntity::COMBAT_ATTACK, 1);
        $pCharacterEntity->addBonus(CharacterEntity::COMBAT_DAMAGE, 1);

        $level = $pCharacterEntity->get(CharacterEntity::FIELD_LEVEL);

        $nbIterations = floor($level / 5);

        for ($i = 0; $i < $nbIterations; $i++) {
            $pCharacterEntity->addBonus(CharacterEntity::SKILL_PHYSICAL, 1);
            $pCharacterEntity->addBonus(CharacterEntity::COMBAT_ATTACK, 1);
            $pCharacterEntity->addBonus(CharacterEntity::COMBAT_DAMAGE, 1);
        }
    }

    /**
     * Each five levels, increase skill physical, combat attack and damage by 1
     */
    public function applyLevelBonus (CharacterEntity $pCharacterEntity) : void
    {
        $level = $pCharacterEntity->get(CharacterEntity::FIELD_LEVEL);

        if (0 !== $level % 5) {
            return;
        }

        $pCharacterEntity->addBonus(CharacterEntity::SKILL_PHYSICAL, 1);
        $pCharacterEntity->addBonus(CharacterEntity::COMBAT_ATTACK, 1);
        $pCharacterEntity->addBonus(CharacterEntity::COMBAT_DAMAGE, 1);
    }

    public function canEquipArmor (ArmorEntity $pArmorEntity) : bool
    {
        return true;
    }

    public function canEquipShield () : bool
    {
        return true;
    }

    public function canCastSpell () : bool
    {
        return false;
    }
}