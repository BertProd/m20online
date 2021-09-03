<?php

namespace M20Online\Entity;

final class ArmorEntity extends EquipmentAbstract
{
    const LOWER_ARMOR = 'lower';

    const MEDIUM_ARMOR = 'medium';

    const HEAVY_ARMOR = 'heavy';

    protected array $data = [
        'name' => '',
        'kind' => '', // lower, medium or heavy
        'price' => ''
    ];

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
