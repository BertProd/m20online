<?php

namespace M20Online\Builder;

use M20Online\Dice\HpDice;
use M20Online\Dice\RandomGenerator;
use M20Online\Dice\StatDice;
use M20Online\Entity\CharacterEntity;
use M20Online\Job\JobFactory;
use M20Online\Race\RaceFactory;

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
