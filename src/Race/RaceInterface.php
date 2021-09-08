<?php
namespace M20OnlineCore\Race;

use M20OnlineCore\Entity\CharacterEntity;

interface RaceInterface
{
    public function applyBonus(CharacterEntity $pCharacterEntity) : void;
}