<?php
/**
 * Call Job to avoid confusion with "classes"
 * 
 * @author Bertrand Andres <bertrand.andres.dev@gmail.com>
 */

namespace M20Online\Job;

use M20Online\Entity\ArmorEntity;
use M20Online\Entity\CharacterEntity;

final class RogueJob extends JobAbstract
{
    const NAME = 'rogue';
    
    /**
     * Rogues have theses bonuses:
     * +3 to Subterfuge.
     * TODO: If they successfully Sneak (usually sub+DEX, but depends on situation) up on a foe 
     *       they can add their Subterfuge skill rank to the damage of their first attack
     */
    public function applyBonus (CharacterEntity $pCharacterEntity) : void
    {
        $pCharacterEntity->addBonus(CharacterEntity::SKILL_SUBTERFUGE, 3);
    }

    public function canEquipArmor (ArmorEntity $pArmorEntity) : bool
    {
        return $pArmorEntity->isLower();
    }

    public function canEquipShield () : bool
    {
        return false;
    }

    public function canCastSpell () : bool
    {
        return false;
    }
}
