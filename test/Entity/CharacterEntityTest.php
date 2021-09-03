<?php

use M20Online\Entity\CharacterEntity;
use PHPUnit\Framework\TestCase;

final class CharacterEntityTest extends TestCase
{
    public function testData ()
    {
        $data = [
            'id' => 42,
            CharacterEntity::STAT_STR => 14,
            CharacterEntity::STAT_DEX => 12,
            CharacterEntity::STAT_MIND => 16,
            'level' => 8,
            'xp' => 85,
            'hp' => 32
        ];

        $characterEntity = new CharacterEntity($data);

        $this->assertSame(42, $characterEntity->get('id'));
        $this->assertSame(14, $characterEntity->get(CharacterEntity::STAT_STR));
        $this->assertSame(12, $characterEntity->get(CharacterEntity::STAT_DEX));
        $this->assertSame(16, $characterEntity->get(CharacterEntity::STAT_MIND));
        $this->assertSame(8, $characterEntity->get('level'));
        $this->assertSame(85, $characterEntity->get('xp'));
        $this->assertSame(32, $characterEntity->get('hp'));
    }

    public function testSetNonExistingData ()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('key non-exists does not exist');

        $data = ['non-exists' => true];

        new CharacterEntity($data);
    }

    public function testGetNonExistingData ()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('key non-exists does not exist');

        $data = ['id' => 28];

        $characterEntity = new CharacterEntity($data);
        $characterEntity->get('non-exists');
    }

    public function testSkillBonusValues ()
    {
        $characterEntity = new CharacterEntity([]);

        $characterEntity->addBonus(CharacterEntity::BONUS_SKILL, CharacterEntity::SKILL_PHYSICAL, 1);
        $characterEntity->addBonus(CharacterEntity::BONUS_SKILL, CharacterEntity::SKILL_SUBTERFUGE, 2);
        $characterEntity->addBonus(CharacterEntity::BONUS_SKILL, CharacterEntity::SKILL_KNOWLEDGE, 3);
        $characterEntity->addBonus(CharacterEntity::BONUS_SKILL, CharacterEntity::SKILL_COMMUNICATION, 4);

        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::BONUS_SKILL, CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(2, $characterEntity->getBonus(CharacterEntity::BONUS_SKILL, CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::BONUS_SKILL, CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(4, $characterEntity->getBonus(CharacterEntity::BONUS_SKILL, CharacterEntity::SKILL_COMMUNICATION));
    }

    public function testSetWrongSkillBonus ()
    {
        $skill = 'non-exists';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Bonus skill '.$skill.' not found');

        $characterEntity = new CharacterEntity([]);
        $characterEntity->addBonus(CharacterEntity::BONUS_SKILL, $skill, 1);
    }

    public function testGetWrongSkillBonus ()
    {
        $skill = 'non-exists';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Bonus skill '.$skill.' not found');

        $characterEntity = new CharacterEntity([]);
        $characterEntity->getBonus(CharacterEntity::BONUS_SKILL, $skill);
    }

    public function testStatBonusValues ()
    {
        $characterEntity = new CharacterEntity([]);

        $characterEntity->addBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_MIND, 1);
        $characterEntity->addBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_STR, 2);
        $characterEntity->addBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_DEX, 3);

        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_MIND));
        $this->assertSame(2, $characterEntity->getBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_STR));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_DEX));
    }

    public function testSetWrongStatBonus ()
    {
        $stat = 'non-exists';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Bonus stat '.$stat.' not found');

        $characterEntity = new CharacterEntity([]);
        $characterEntity->addBonus(CharacterEntity::BONUS_STAT, $stat, 1);
    }

    public function testGetWrongStatBonus ()
    {
        $stat = 'non-exists';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Bonus stat '.$stat.' not found');

        $characterEntity = new CharacterEntity([]);
        $characterEntity->getBonus(CharacterEntity::BONUS_STAT, $stat);
    }

    public function testGetStatBonusFromSkill ()
    {
        $characterEntity = new CharacterEntity([]);

        $characterEntity->addBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_MIND, 1);
        $characterEntity->addBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_STR, 2);
        $characterEntity->addBonus(CharacterEntity::BONUS_STAT, CharacterEntity::STAT_DEX, 3);

        $this->assertSame(1, $characterEntity->getStatBonusFromSkill (CharacterEntity::SKILL_COMMUNICATION));
        $this->assertSame(1, $characterEntity->getStatBonusFromSkill (CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(2, $characterEntity->getStatBonusFromSkill (CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(3, $characterEntity->getStatBonusFromSkill (CharacterEntity::SKILL_SUBTERFUGE));
    }

    public function testWrongGetStatBonusFromSkill ()
    {
        $stat = 'non-exists';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Skill '.$stat.' not found');

        $characterEntity = new CharacterEntity([]);
        $characterEntity->getStatBonusFromSkill($stat, 1);
    }
}

