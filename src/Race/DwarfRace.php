<?php
/**
 * According to microlite20 rules, dwarves get bonus +2 in strength
 * 
 * @author Bertrand Andres
 */
namespace M20Online\Race;

use M20Online\Entity\CharacterEntity;

final class DwarfRace extends RaceAbstract
{
    public function applyBonus (CharacterEntity $pCharacterEntity) : void
    {
        $pCharacterEntity->addBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_STR, 2);
    }
}