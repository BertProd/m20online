<?php
/**
 * According to microlite20 rules, halflings get bonus +2 in dexterity
 * 
 * @author Bertrand Andres
 */
namespace M20OnlineCore\Race;

use M20OnlineCore\Entity\CharacterEntity;

final class HalflingRace extends RaceAbstract
{
    const NAME = 'halfling';

    public function applyBonus (CharacterEntity $pCharacterEntity) : void
    {
        $pCharacterEntity->addBonus(CharacterEntity::STAT_DEX, 2);
    }
}