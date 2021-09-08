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
    const NAME = 'dwarf';
    
    public function applyBonus (CharacterEntity $pCharacterEntity) : void
    {
        $pCharacterEntity->addBonus(CharacterEntity::STAT_STR, 2);
    }
}