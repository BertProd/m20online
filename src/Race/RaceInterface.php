<?php
namespace M20Online\Race;

use M20Online\Entity\CharacterEntity;

interface RaceInterface
{
    public function applyBonus(CharacterEntity $pCharacterEntity) : void;
}