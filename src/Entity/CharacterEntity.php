<?php
namespace M20Online\Entity;

use InvalidArgumentException;
use LogicException;

final class CharacterEntity extends EntityAbstract
{
    const STAT_STR = 'str';
    const STAT_DEX = 'dex';
    const STAT_MIND = 'mind';

    const SKILL_PHYSICAL = 'physical';
    const SKILL_SUBTERFUGE = 'subterfuge';
    const SKILL_KNOWLEDGE = 'knowledge';
    const SKILL_COMMUNICATION = 'communication';

    private array $statsList = [self::STAT_STR, self::STAT_DEX, self::STAT_MIND];

    private array $skillsList = [self::SKILL_PHYSICAL, self::SKILL_SUBTERFUGE, self::SKILL_KNOWLEDGE, self::SKILL_COMMUNICATION];

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
        if (in_array($pKey, $this->statsList)) {
            // it's a stat, calc bonus:
            $this->statsbonus[$pKey] = floor(($pValue - 10) / 2);
        }

        parent::set($pKey, $pValue);
    }

    /**
     * To roll a stat, roll 4D6, delete lowest value then sum others.
     * 
     * @return int stat value
     */
    private function rollStatValue () : int
    {
        $resultsList = [];

        // Generate values
        for ($i = 0; $i < 4; $i++) {
            $resultsList[] = rand(1, 6);
        }

        // Drop lowest value
        sort($resultsList);
        array_shift($resultsList);

        // Sum remaining values and return it: 
        return array_sum($resultsList);
    }

    /**
     * @param string $pStat stat name
     * @return int stat value
     */
    public function generateStat (string $pStat) : void
    {
        if (!in_array($pStat, $this->statsList)) {
            throw new InvalidArgumentException('Stat '.$pStat.' not found');
        }
        
        $statValue = $this->rollStatValue();
        $this->set($pStat, $statValue);
    }

    /**
     * You roll HP value by adding 1D6 to your strength value
     */
    public function rollHp () : void
    {
        $statStr = $this->get(self::STAT_STR);

        if (0 === $this->get($statStr)) {
            throw new LogicException('You must roll strength stat before roll hp');
        }

        $this->set('hp', $statStr + rand(1, 6));
    }

    /**
     * How to roll a skill check:
     * 1D20 + bonus skill + level + stat bonus + any other bonus value
     */
    public function rollSkillCheck (string $pSkill, int $pOtherBonus = 0) : int
    {
        if (!in_array($pSkill, $this->skillsList)) {
            throw new InvalidArgumentException('Skill '.$pSkill.' not found');
        }

        return rand(1, 20) + $this->skillsBonusList[$pSkill] + $this->getStatBonusFromSkill($pSkill) + $pOtherBonus;
    }

    public function applySkillBonus (string $pSkill, int $pValue)
    {
        if (!in_array($pSkill, $this->skillsList)) {
            throw new InvalidArgumentException('Skill '.$pSkill.' not found');
        }

        $this->skillsBonusList[$pSkill] += $pValue;
    }

    public function applyStatBonus (string $pStat, int $pValue)
    {
        if (!in_array($pStat, $this->statBonusList)) {
            throw new InvalidArgumentException('Stat '.$pStat.' not found');
        }

        $this->statBonusList[$pStat] = $pValue;
    }

    private function getStatBonusFromSkill ($pSkill) : int
    {
        if (self::SKILL_COMMUNICATION === $pSkill) {
            return self::statBonusList[self::STAT_MIND];
        }

        if (self::SKILL_KNOWLEDGE === $pSkill) {
            return self::statBonusList[self::STAT_MIND];
        }

        if (self::SKILL_PHYSICAL === $pSkill) {
            return self::statBonusList[self::STAT_STR];
        }

        if (self::SKILL_SUBTERFUGE === $pSkill) {
            return self::statBonusList[self::STAT_DEX];
        }

        throw new LogicException('Skill '.$pSkill.' not found.');
    }
}
