<?php
/**
 * According to microlite20 rules, halflings get bonus +2 in dexterity
 * 
 * @author Bertrand Andres
 */
namespace M20Online\Race;

use M20Online\Entity\CharacterEntity;

final class HalflingRace extends RaceAbstract
{
    public function applyBonus (CharacterEntity $pCharacterEntity) : void
    {
        $pCharacterEntity->addStatBonus(CharacterEntity::STAT_DEX, 2);
    }
}