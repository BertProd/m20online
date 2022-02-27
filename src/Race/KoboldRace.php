<?php

/**
 * According to microlite20 rules, kobolds get following bonuses:
 *  -2 in strength
 *  +4 in dextery
 *
 * @author Bertrand Andres
 */

namespace M20OnlineCore\Race;

use M20OnlineCore\Entity\CharacterEntity;

final class KoboldRace extends CharacterEntity
{
    public const NAME = 'kobold';

    public function applyBonus(CharacterEntity $pCharacterEntity): void
    {
        $pCharacterEntity->addBonus(CharacterEntity::STAT_STR, -2);
        $pCharacterEntity->addBonus(CharacterEntity::STAT_DEX, 4);
    }
}

