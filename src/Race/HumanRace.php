<?php
namespace M20Online\Race;

use M20Online\Entity\CharacterEntity;

final class HumanRace extends RaceAbstract
{
    public function applyBonus(CharacterEntity $pCharacterEntity)
    {
        $pCharacterEntity->applySkillBonus(CharacterEntity::SKILL_COMMUNICATION, 1);
        $pCharacterEntity->applySkillBonus(CharacterEntity::SKILL_KNOWLEDGE, 1);
        $pCharacterEntity->applySkillBonus(CharacterEntity::SKILL_PHYSICAL, 1);
        $pCharacterEntity->applySkillBonus(CharacterEntity::SKILL_SUBTERFUGE, 1);
    }
}