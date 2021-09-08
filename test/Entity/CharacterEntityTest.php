<?php

use M20OnlineCore\Entity\CharacterEntity;
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
            CharacterEntity::FIELD_LEVEL => 8,
            CharacterEntity::FIELD_XP => 85,
            CharacterEntity::FIELD_HP => 32
        ];

        $characterEntity = new CharacterEntity($data);

        $this->assertSame(42, $characterEntity->get('id'));
        $this->assertSame(14, $characterEntity->get(CharacterEntity::STAT_STR));
        $this->assertSame(12, $characterEntity->get(CharacterEntity::STAT_DEX));
        $this->assertSame(16, $characterEntity->get(CharacterEntity::STAT_MIND));
        $this->assertSame(8, $characterEntity->get(CharacterEntity::FIELD_LEVEL));
        $this->assertSame(85, $characterEntity->get(CharacterEntity::FIELD_XP));
        $this->assertSame(32, $characterEntity->get(CharacterEntity::FIELD_HP));
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

        $characterEntity->addBonus(CharacterEntity::SKILL_PHYSICAL, 1);
        $characterEntity->addBonus(CharacterEntity::SKILL_SUBTERFUGE, 2);
        $characterEntity->addBonus(CharacterEntity::SKILL_KNOWLEDGE, 3);
        $characterEntity->addBonus(CharacterEntity::SKILL_COMMUNICATION, 4);

        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::SKILL_PHYSICAL));
        $this->assertSame(2, $characterEntity->getBonus(CharacterEntity::SKILL_SUBTERFUGE));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::SKILL_KNOWLEDGE));
        $this->assertSame(4, $characterEntity->getBonus(CharacterEntity::SKILL_COMMUNICATION));
    }

    public function testSetWrongSkillBonus ()
    {
        $skill = 'non-exists';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Bonus '.$skill.' not found');

        $characterEntity = new CharacterEntity([]);
        $characterEntity->addBonus($skill, 1);
    }

    public function testGetWrongSkillBonus ()
    {
        $skill = 'non-exists';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Bonus '.$skill.' not found');

        $characterEntity = new CharacterEntity([]);
        $characterEntity->getBonus($skill);
    }

    public function testStatBonusValues ()
    {
        $characterEntity = new CharacterEntity([]);

        $characterEntity->addBonus(CharacterEntity::STAT_MIND, 1);
        $characterEntity->addBonus(CharacterEntity::STAT_STR, 2);
        $characterEntity->addBonus(CharacterEntity::STAT_DEX, 3);

        $this->assertSame(1, $characterEntity->getBonus(CharacterEntity::STAT_MIND));
        $this->assertSame(2, $characterEntity->getBonus(CharacterEntity::STAT_STR));
        $this->assertSame(3, $characterEntity->getBonus(CharacterEntity::STAT_DEX));
    }

    public function testSetWrongStatBonus ()
    {
        $stat = 'non-exists';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Bonus '.$stat.' not found');

        $characterEntity = new CharacterEntity([]);
        $characterEntity->addBonus($stat, 1);
    }

    public function testGetWrongStatBonus ()
    {
        $stat = 'non-exists';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Bonus '.$stat.' not found');

        $characterEntity = new CharacterEntity([]);
        $characterEntity->getBonus($stat);
    }

    public function testGetStatBonusFromSkill ()
    {
        $characterEntity = new CharacterEntity([]);

        $characterEntity->addBonus(CharacterEntity::STAT_MIND, 1);
        $characterEntity->addBonus(CharacterEntity::STAT_STR, 2);
        $characterEntity->addBonus(CharacterEntity::STAT_DEX, 3);

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

