<?php

/**
 * According to microlite20 rules, lizardmen get following bonuses:
 *  +2 in strength
 *  +2 in dextery
 *  -2 in mind
 *
 * @author Bertrand Andres
 */

namespace M20OnlineCore\Race;

use M20OnlineCore\Entity\CharacterEntity;

final class LizardmanRace extends CharacterEntity
{
    public const NAME = 'lizardman';

    public function applyBonus(CharacterEntity $pCharacterEntity): void
    {
        $pCharacterEntity->addBonus(CharacterEntity::STAT_STR, 2);
        $pCharacterEntity->addBonus(CharacterEntity::STAT_DEX, 2);
        $pCharacterEntity->addBonus(CharacterEntity::STAT_MIND, -2);
    }
}

