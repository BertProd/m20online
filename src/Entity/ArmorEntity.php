<?php

namespace M20Online\Entity;

final class ArmorEntity extends EquipmentAbstract
{
    protected array $data = [
        'name' => '',
        'kind' => '', // lower, medium or heavy
        'price' => ''
    ];
}
