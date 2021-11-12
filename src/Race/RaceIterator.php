<?php

namespace M20OnlineCore\Race;

use Iterator;

final class RaceIterator implements Iterator
{
    private int $counter = 0;

    private array $data = [
        DwarfRace::NAME,
        ElfRace::NAME,
        HalflingRace::NAME,
        HumanRace::NAME
    ];

    public function rewind ()
    {
        $this->counter = 0;
    }

    public function next ()
    {
        ++$this->counter;
    }

    public function key ()
    {
        return $this->counter;
    }

    public function current ()
    {
        return $this->data[$this->counter];
    }

    public function valid ()
    {
        return $this->counter < count($this->data);
    }
}