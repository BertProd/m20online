<?php

namespace M20OnlineCore\Entity;

final class ArmorEntity extends EntityAbstract
{
    const FIELD_NAME = 'field_name';
    const FIELD_KIND = 'field_kind';
    const FIELD_PRICE = 'field_price';

    const KIND_LOWER_ARMOR = 'lower';
    const KIND_MEDIUM_ARMOR = 'medium';
    const KIND_HEAVY_ARMOR = 'heavy';

    protected array $data = [
        self::FIELD_NAME => '',
        self::FIELD_KIND => '', // lower, medium or heavy
        self::FIELD_PRICE => 0
    ];

    /**
     * @return bool
     */
    public function isLower() : bool
    {
        return self::KIND_LOWER_ARMOR === $this->data[ArmorEntity::FIELD_KIND];
    }

    /**
     * @return bool
     */
    public function isMedium() : bool
    {
        return self::KIND_MEDIUM_ARMOR === $this->data[ArmorEntity::FIELD_KIND];
    }

    /**
     * @return bool
     */
    public function isHeavy() : bool
    {
        return self::KIND_HEAVY_ARMOR === $this->data[ArmorEntity::FIELD_KIND];
    }
}
