<?php

namespace M20Online\Entity;

final class WeaponEntity extends EntityAbstract
{
    const KIND_ONE_HANDED = 'kind_one_handed';
    const KIND_TWO_HANDED = 'kind_two_handed';
    const KIND_LOW = 'kind_low';
    const KIND_DISTANT = 'kind_distant';

    const FIELD_NAME = 'field_name';
    const FIELD_KIND = 'field_kind';
    const FIELD_PRICE = 'field_price';

    protected array $data = [
        self::FIELD_NAME => '',
        self::FIELD_KIND => '',
        self::FIELD_PRICE => 0
    ];
}