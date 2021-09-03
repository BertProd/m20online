<?php
namespace M20Online\Entity;

use InvalidArgumentException;

final class CharacterEntity extends EntityAbstract
{
    const COMBAT_ATTACK = 'attack';
    const COMBAT_DAMAGE = 'damage';

    const STAT_STR = 'str';
    const STAT_DEX = 'dex';
    const STAT_MIND = 'mind';

    const SKILL_PHYSICAL = 'physical';
    const SKILL_SUBTERFUGE = 'subterfuge';
    const SKILL_KNOWLEDGE = 'knowledge';
    const SKILL_COMMUNICATION = 'communication';

    private array $combatBonusList = [
        self::COMBAT_ATTACK => 0,
        self::COMBAT_DAMAGE => 0
    ];

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

    public function addSkillBonus (string $pSkill, int $pValue)
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

    public function addStatBonus (string $pStat, int $pValue)
    {
        if (!array_key_exists($pStat, $this->statsBonusList)) {
            throw new InvalidArgumentException('Stat '.$pStat.' not found');
        }

        $this->statsBonusList[$pStat] += $pValue;
    }

    public function getStatBonus (string $pStat) : int
    {
        if (!array_key_exists($pStat, $this->statsBonusList)) {
            throw new InvalidArgumentException('Stat '.$pStat.' not found');
        }

        return $this->statsBonusList[$pStat];
    }

    public function getStatBonusFromSkill ($pSkill) : int
    {
        if (self::SKILL_COMMUNICATION === $pSkill) {
            return $this->statsBonusList[self::STAT_MIND];
        }

        if (self::SKILL_KNOWLEDGE === $pSkill) {
            return $this->statsBonusList[self::STAT_MIND];
        }

        if (self::SKILL_PHYSICAL === $pSkill) {
            return $this->statsBonusList[self::STAT_STR];
        }

        if (self::SKILL_SUBTERFUGE === $pSkill) {
            return $this->statsBonusList[self::STAT_DEX];
        }

        throw new InvalidArgumentException('Skill '.$pSkill.' not found.');
    }
}
