<?php
/**
 * Call Job to avoid confusion with "classes"
 * 
 * @author Bertrand Andres <bertrand.andres.dev@gmail.com>
 */

namespace M20Online\Job;

use M20Online\Entity\ArmorEntity;
use M20Online\Entity\CharacterEntity;

interface JobInterface
{
    public function applyBonus (CharacterEntity $pCharacterEntity) : void;

    public function canEquipArmor (ArmorEntity $pArmorEntity) : bool;

    public function canEquipShield () : bool;

    public function canCastSpell () : bool;
}