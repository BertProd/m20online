<?php
namespace M20Online\Race;

use InvalidArgumentException;
use LogicException;

final class RaceFactory
{
    public function __construct() { }

    public function factory ($pValue) : RaceAbstract
    {
        $className = $this->generateClassName($pValue);

        if (!class_exists($className)) {
            throw new InvalidArgumentException('Race '.$pValue.' not found');
        }

        if (!in_array('RaceInterface', class_implements($className))) {
            throw new LogicException('Race '.$pValue.' does not implement RaceInterface');
        }

        return new $className();
    }

    private function generateClassName($pValue) : string
    {
        return ucfirst(strtolower($pValue)).'Race';
    }
}