<?php
namespace M20Online\Entity;

use InvalidArgumentException;

abstract class EntityAbstract
{
    private int $id = 0;

    protected array $data = [];

    public function __construct (array $pData = [])
    {
        foreach ($pData as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function set(string $pKey, $pValue) : void
    {
        if ('id' === $pKey) {
            $this->id = $pValue;
            return;
        }

        if (!array_key_exists($pKey, $this->data)) {
            throw new InvalidArgumentException('key '.$pKey.' does not exist');
        }

        $this->data[$pKey] = $pValue;
    }

    public function get(string $pKey)
    {
        if ('id' === $pKey) {
            return $this->id;
        }
        
        if (!array_key_exists($pKey, $this->data)) {
            throw new InvalidArgumentException('key '.$pKey.' does not exist');
        }

        return $this->data[$pKey];
    }
}
