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
            throw new InvalidArgumentException('Race '.$pValue.' ('.$className.') not found');
        }

        if (!in_array(__NAMESPACE__.'\RaceInterface', class_implements($className))) {
            throw new LogicException('Race '.$pValue.' does not implement RaceInterface');
        }

        return new $className();
    }

    private function generateClassName($pValue) : string
    {
        return __NAMESPACE__.'\\'.ucfirst(strtolower($pValue)).'Race';
    }
}