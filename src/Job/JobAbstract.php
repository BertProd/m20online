<?php
/**
 * Call Job to avoid confusion with "classes"
 * 
 * @author Bertrand Andres <bertrand.andres.dev@gmail.com>
 */

namespace M20Online\Job;

use M20Online\Entity\CharacterEntity;

abstract class JobAbstract implements JobInterface
{
    public function applyLevelBonus (CharacterEntity $pCharacterEntity) : void {}
}
