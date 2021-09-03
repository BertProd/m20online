<?php
/**
 * This class allow us to know if equipment is lower, medium or heavy.
 * To be able to use it, the equipment entity class must extend this class
 * and declare "kind" key in protected $data array.
 * 
 * @author Bertrand Andres
 */
namespace M20Online\Entity;

abstract class EquipmentAbstract extends EntityAbstract
{
    const LOWER_ARMOR = 'lower';

    const MEDIUM_ARMOR = 'medium';

    const HEAVY_ARMOR = 'heavy';

    /**
     * @return bool
     */
    public function isLower() : bool
    {
        return self::LOWER_ARMOR === $this->data['kind'];
    }

    /**
     * @return bool
     */
    public function isMedium() : bool
    {
        return self::MEDIUM_ARMOR === $this->data['kind'];
    }

    /**
     * @return bool
     */
    public function isHeavy() : bool
    {
        return self::HEAVY_ARMOR === $this->data['kind'];
    }
}