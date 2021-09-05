<?php

namespace M20Online\Job;

use InvalidArgumentException;
use LogicException;
use ReflectionClass;

final class JobFactory
{
    public function factory (string $pValue) : JobAbstract
    {
        $className = $this->generateClassName($pValue);

        if (!class_exists($className)) {
            throw new InvalidArgumentException('Job '.$pValue.' ('.$className.') not found');
        }

        if (!in_array(__NAMESPACE__.'\JobInterface', class_implements($className))) {
            throw new LogicException('Job '.$pValue.' does not implement JobInterface');
        }

        $reflectedClass = new ReflectionClass($className);
        return $reflectedClass->newInstance();
    }

    private function generateClassName($pValue) : string
    {
        return __NAMESPACE__.'\\'.ucfirst(strtolower($pValue)).'Job';
    }
}
