<?php

namespace M20OnlineCore\Race;

use InvalidArgumentException;
use LogicException;
use ReflectionClass;

final class RaceFactory
{
    public function __construct()
    {
    }

    public function factory($pValue): RaceAbstract
    {
        $className = $this->generateClassName($pValue);
        if (!class_exists($className)) {
            throw new InvalidArgumentException('Race ' . $pValue . ' (' . $className . ') not found');
        }

        if (!in_array(__NAMESPACE__ . '\RaceInterface', class_implements($className))) {
            throw new LogicException('Race ' . $pValue . ' does not implement RaceInterface');
        }

        $reflectedClass = new ReflectionClass($className);
        return $reflectedClass->newInstance();
    }

    private function generateClassName($pValue): string
    {
        return __NAMESPACE__ . '\\' . ucfirst(strtolower($pValue)) . 'Race';
    }
}
