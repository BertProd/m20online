<?php

/**
 * Call Job to avoid confusion with "classes"
 *
 * @author Bertrand Andres <bertrand.andres.dev@gmail.com>
 */

namespace M20OnlineCore\Job;

use M20OnlineCore\Entity\ArmorEntity;
use M20OnlineCore\Entity\CharacterEntity;

interface JobInterface
{
    public function applyBonus(CharacterEntity $pCharacterEntity): void;
    public function applyLevelBonus(CharacterEntity $pCharacterEntity): void;
    public function canEquipArmor(ArmorEntity $pArmorEntity): bool;
    public function canEquipShield(): bool;
    public function canCastSpell(): bool;
}
