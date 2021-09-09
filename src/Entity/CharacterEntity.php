<?php

namespace M20OnlineCore\Entity;

use InvalidArgumentException;

final class CharacterEntity extends EntityAbstract
{
    public const COMBAT_ATTACK = 'combat_attack';
    public const COMBAT_DAMAGE = 'combat_damage';
    public const STAT_STR = 'stat_str';
    public const STAT_DEX = 'stat_dex';
    public const STAT_MIND = 'stat_mind';
    public const SKILL_PHYSICAL = 'skill_physical';
    public const SKILL_SUBTERFUGE = 'skill_subterfuge';
    public const SKILL_KNOWLEDGE = 'skill_knowledge';
    public const SKILL_COMMUNICATION = 'skill_communication';
    public const FIELD_NAME = 'field_name';
    public const FIELD_RACE = 'field_race';
    public const FIELD_JOB = 'field_job';
    public const FIELD_LEVEL = 'field_level';
    public const FIELD_XP = 'field_xp';
    public const FIELD_HP = 'field_hp';

    private $bonusList = [
        self::COMBAT_ATTACK => 0,
        self::COMBAT_DAMAGE => 0,
        self::STAT_STR => 0,
        self::STAT_DEX => 0,
        self::STAT_MIND => 0,
        self::SKILL_PHYSICAL => 0,
        self::SKILL_SUBTERFUGE => 0,
        self::SKILL_KNOWLEDGE => 0,
        self::SKILL_COMMUNICATION => 0
    ];

    protected array $data = [
        self::FIELD_NAME => '',
        self::FIELD_RACE => '',
        self::FIELD_JOB => '',
        self::STAT_STR => 0,
        self::STAT_DEX => 0,
        self::STAT_MIND => 0,
        self::FIELD_LEVEL => 1,
        self::FIELD_XP => 0,
        self::FIELD_HP => 0
    ];

    public function set(string $pKey, $pValue): void
    {
        if (in_array($pKey, [self::STAT_STR, self::STAT_DEX, self::STAT_MIND])) {
            // it's a stat, calc bonus:
            $this->addBonus($pKey, floor(($pValue - 10) / 2));
        }

        parent::set($pKey, $pValue);
    }

    private function checkBonusExists(string $pBonus): void
    {
        if (!array_key_exists($pBonus, $this->bonusList)) {
            throw new InvalidArgumentException('Bonus ' . $pBonus . ' not found');
        }
    }

    public function addBonus(string $pBonus, int $pValue): void
    {
        if ($pValue < 0) {
            return;
        }

        $this->checkBonusExists($pBonus);
        $this->bonusList[$pBonus] += $pValue;
    }

    public function getBonus(string $pBonus): int
    {
        $this->checkBonusExists($pBonus);
        return $this->bonusList[$pBonus];
    }

    public function getStatBonusFromSkill($pSkill): int
    {
        if (self::SKILL_COMMUNICATION === $pSkill) {
            return $this->getBonus(self::STAT_MIND);
        }

        if (self::SKILL_KNOWLEDGE === $pSkill) {
            return $this->getBonus(self::STAT_MIND);
        }

        if (self::SKILL_PHYSICAL === $pSkill) {
            return $this->getBonus(self::STAT_STR);
        }

        if (self::SKILL_SUBTERFUGE === $pSkill) {
            return $this->getBonus(self::STAT_DEX);
        }

        throw new InvalidArgumentException('Skill ' . $pSkill . ' not found.');
    }
}
