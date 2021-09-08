<?php
/**
 * According to microlite20 rules, elves get bonus +2 in mind
 * 
 * @author Bertrand Andres
 */
namespace M20OnlineCore\Race;

use M20OnlineCore\Entity\CharacterEntity;

final class ElfRace extends RaceAbstract
{
    const NAME = 'elf';
    
    public function applyBonus (CharacterEntity $pCharacterEntity) : void
    {
        $pCharacterEntity->addBonus(CharacterEntity::STAT_MIND, 2);
    }
}