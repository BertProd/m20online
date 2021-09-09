<?php

/**
 * According to microlite20 rules, humans get bonus +1 for each skill
 *
 * @author Bertrand Andres
 */

namespace M20OnlineCore\Race;

use M20OnlineCore\Entity\CharacterEntity;

final class HumanRace extends RaceAbstract
{
    public const NAME = 'human';

    public function applyBonus(CharacterEntity $pCharacterEntity): void
    {
        $skills = [
            CharacterEntity::SKILL_COMMUNICATION,
            CharacterEntity::SKILL_KNOWLEDGE,
            CharacterEntity::SKILL_PHYSICAL,
            CharacterEntity::SKILL_SUBTERFUGE
        ];
        foreach ($skills as $skill) {
            $pCharacterEntity->addBonus($skill, 1);
        }
    }
}
