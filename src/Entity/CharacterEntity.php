<?php
namespace M20Online\Entity;

use InvalidArgumentException;

final class CharacterEntity extends EntityAbstract
{
    const STAT_STR = 'str';
    const STAT_DEX = 'dex';
    const STAT_MIND = 'mind';

    const SKILL_PHYSICAL = 'physical';
    const SKILL_SUBTERFUGE = 'subterfuge';
    const SKILL_KNOWLEDGE = 'knowledge';
    const SKILL_COMMUNICATION = 'communication';

    private array $statsBonusList = [
        self::STAT_STR => 0,
        self::STAT_DEX => 0,
        self::STAT_MIND => 0
    ];

    private array $skillsBonusList = [
        self::SKILL_PHYSICAL => 0,
        self::SKILL_SUBTERFUGE => 0,
        self::SKILL_KNOWLEDGE => 0,
        self::SKILL_COMMUNICATION => 0
    ];

    protected array $data = [
        'name' => '',
        self::STAT_STR => 0,
        self::STAT_DEX => 0,
        self::STAT_MIND => 0,
        'level' => 1,
        'xp' => 0,
        'hp' => 0
    ];

    public function set(string $pKey, $pValue) : void
    {
        if (array_key_exists($pKey, $this->statsBonusList)) {
            // it's a stat, calc bonus:
            $this->statsBonusList[$pKey] = floor(($pValue - 10) / 2);
        }

        parent::set($pKey, $pValue);
    }

    public function setSkillBonus (string $pSkill, int $pValue)
    {
        if (!array_key_exists($pSkill, $this->skillsBonusList)) {
            throw new InvalidArgumentException('Skill '.$pSkill.' not found');
        }

        $this->skillsBonusList[$pSkill] += $pValue;
    }

    public function getSkillBonus (string $pSkill) : int
    {
        if (!array_key_exists($pSkill, $this->skillsBonusList)) {
            throw new InvalidArgumentException('Skill '.$pSkill.' not found');
        }

        return $this->skillsBonusList[$pSkill];
    }

    public function setStatBonus (string $pStat, int $pValue)
    {
        if (!array_key_exists($pStat, $this->statsBonusList)) {
            throw new InvalidArgumentException('Stat '.$pStat.' not found');
        }

        $this->statBonusList[$pStat] = $pValue;
    }

    public function getStatBonus (string $pStat) : int
    {
        if (!array_key_exists($pStat, $this->statsBonusList)) {
            throw new InvalidArgumentException('Stat '.$pStat.' not found');
        }

        return $this->statBonusList[$pStat];
    }

    public function getStatBonusFromSkill ($pSkill) : int
    {
        if (self::SKILL_COMMUNICATION === $pSkill) {
            return $this->statBonusList[self::STAT_MIND];
        }

        if (self::SKILL_KNOWLEDGE === $pSkill) {
            return $this->statBonusList[self::STAT_MIND];
        }

        if (self::SKILL_PHYSICAL === $pSkill) {
            return $this->statBonusList[self::STAT_STR];
        }

        if (self::SKILL_SUBTERFUGE === $pSkill) {
            return $this->statBonusList[self::STAT_DEX];
        }

        throw new InvalidArgumentException('Skill '.$pSkill.' not found.');
    }
}
