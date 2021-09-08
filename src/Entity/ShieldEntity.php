<?php

namespace M20OnlineCore\Entity;

final class ShieldEntity extends EntityAbstract
{
    const FIELD_NAME = 'field_name';
    const FIELD_PRICE = 'field_price';

    protected array $data = [
        self::FIELD_NAME => '',
        self::FIELD_PRICE => 0
    ];
}