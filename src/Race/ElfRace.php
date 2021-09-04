<?php
/**
 * According to microlite20 rules, elves get bonus +2 in mind
 * 
 * @author Bertrand Andres
 */
namespace M20Online\Race;

use M20Online\Entity\CharacterEntity;

final class ElfRace extends RaceAbstract
{
    public function applyBonus (CharacterEntity $pCharacterEntity) : void
    {
        $pCharacterEntity->addBonus(CharacterEntity::STAT_MIND, 2);
    }
}