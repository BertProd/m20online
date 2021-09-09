<?php

namespace M20OnlineCore\Entity;

final class WeaponEntity extends EntityAbstract
{
    public const KIND_ONE_HANDED = 'kind_one_handed';
    public const KIND_TWO_HANDED = 'kind_two_handed';
    public const KIND_LOW = 'kind_low';
    public const KIND_DISTANT = 'kind_distant';

    public const FIELD_NAME = 'field_name';
    public const FIELD_KIND = 'field_kind';
    public const FIELD_PRICE = 'field_price';

    protected array $data = [
        self::FIELD_NAME => '',
        self::FIELD_KIND => '',
        self::FIELD_PRICE => 0
    ];
}
