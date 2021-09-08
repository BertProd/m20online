<?php

namespace M20OnlineCore\Builder;

use M20OnlineCore\Dice\HpDice;
use M20OnlineCore\Dice\RandomGenerator;
use M20OnlineCore\Dice\StatDice;
use M20OnlineCore\Entity\CharacterEntity;
use M20OnlineCore\Job\JobFactory;
use M20OnlineCore\Race\RaceFactory;

final class CharacterBuilder extends BuilderAbstract
{
    public function build (string $pRace, string $pJob) : CharacterEntity
    {
        $characterEntity = new CharacterEntity([
            CharacterEntity::FIELD_LEVEL => 1,
            CharacterEntity::FIELD_RACE => $pRace,
            CharacterEntity::FIELD_JOB => $pJob
        ]);

        $this->applyBonus($characterEntity);
        $this->rollStats($characterEntity);
        $this->rollHp($characterEntity);

        return $characterEntity;
    }

    private function applyBonus (CharacterEntity $pCharacterEntity) : void
    {
        $raceFactory = new RaceFactory();
        $race = $raceFactory->factory($pCharacterEntity->get(CharacterEntity::FIELD_RACE));

        $race->applyBonus($pCharacterEntity);

        $jobFactory = new JobFactory();
        $job = $jobFactory->factory($pCharacterEntity->get(CharacterEntity::FIELD_JOB));

        $job->applyBonus($pCharacterEntity);
    }

    private function rollHp (CharacterEntity $pCharacterEntity) : void
    {
        $randomGenerator = new RandomGenerator();
        $hpDice = new HpDice($randomGenerator);

        $statStr = $pCharacterEntity->get(CharacterEntity::STAT_STR);
        $bonusStr = $pCharacterEntity->getBonus(CharacterEntity::STAT_STR);

        $hp = $statStr + $bonusStr + $hpDice->roll();
        $pCharacterEntity->set(CharacterEntity::FIELD_HP, $hp);
    }

    private function rollStats (CharacterEntity $pCharacterEntity) : void
    {
        $randomGenerator = new RandomGenerator();
        $statDice = new StatDice($randomGenerator);

        $pCharacterEntity->set(CharacterEntity::STAT_DEX, $statDice->roll());
        $pCharacterEntity->set(CharacterEntity::STAT_MIND, $statDice->roll());
        $pCharacterEntity->set(CharacterEntity::STAT_STR, $statDice->roll());
    }
}
