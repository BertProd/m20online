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
        $currentStatBonus = $pCharacterEntity->getStatBonus(CharacterEntity::STAT_STR);

        $pCharacterEntity->setStatBonus(CharacterEntity::STAT_STR, $currentStatBonus + 2);
    }
}