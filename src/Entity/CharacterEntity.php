<?php
namespace M20Online\Entity;

use InvalidArgumentException;

final class CharacterEntity extends EntityAbstract
{
    const BONUS_COMBAT = 'combat';
    const BONUS_SKILL = 'skill';
    const BONUS_STAT = 'stat';

    const COMBAT_ATTACK = 'attack';
    const COMBAT_DAMAGE = 'damage';

    const STAT_STR = 'str';
    const STAT_DEX = 'dex';
    const STAT_MIND = 'mind';

    const SKILL_PHYSICAL = 'physical';
    const SKILL_SUBTERFUGE = 'subterfuge';
    const SKILL_KNOWLEDGE = 'knowledge';
    const SKILL_COMMUNICATION = 'communication';

    private $bonusList = [
        self::BONUS_COMBAT => [
            self::COMBAT_ATTACK => 0,
            self::COMBAT_DAMAGE => 0    
        ],
        self::BONUS_STAT => [
            self::STAT_STR => 0,
            self::STAT_DEX => 0,
            self::STAT_MIND => 0    
        ],
        self::BONUS_SKILL => [
            self::SKILL_PHYSICAL => 0,
            self::SKILL_SUBTERFUGE => 0,
            self::SKILL_KNOWLEDGE => 0,
            self::SKILL_COMMUNICATION => 0
        ]
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
        if (array_key_exists($pKey, $this->bonusList[self::BONUS_STAT])) {
            // it's a stat, calc bonus:
            $this->addBonus(self::BONUS_STAT, $pKey, floor(($pValue - 10) / 2));
        }

        parent::set($pKey, $pValue);
    }

    private function checkBonusExists(string $pBonusType, string $pBonus) : void
    {
        if (
                !array_key_exists($pBonusType, $this->bonusList)
            ||  !array_key_exists($pBonus, $this->bonusList[$pBonusType])
        ) {
            throw new InvalidArgumentException('Bonus '.$pBonusType.' '.$pBonus.' not found');
        }
    }

    public function addBonus (string $pBonusType, string $pBonus, int $pValue) : void
    {
        $this->checkBonusExists($pBonusType, $pBonus);

        $this->bonusList[$pBonusType][$pBonus] += $pValue;
    }

    public function getBonus (string $pBonusType, string $pBonus) : int
    {
        $this->checkBonusExists($pBonusType, $pBonus);

        return $this->bonusList[$pBonusType][$pBonus];
    }

    public function getStatBonusFromSkill ($pSkill) : int
    {
        if (self::SKILL_COMMUNICATION === $pSkill) {
            return $this->getBonus(self::BONUS_STAT, self::STAT_MIND);
        }

        if (self::SKILL_KNOWLEDGE === $pSkill) {
            return $this->getBonus(self::BONUS_STAT, self::STAT_MIND);
        }

        if (self::SKILL_PHYSICAL === $pSkill) {
            return $this->getBonus(self::BONUS_STAT, self::STAT_STR);
        }

        if (self::SKILL_SUBTERFUGE === $pSkill) {
            return $this->getBonus(self::BONUS_STAT, self::STAT_DEX);
        }

        throw new InvalidArgumentException('Skill '.$pSkill.' not found.');
    }
}
