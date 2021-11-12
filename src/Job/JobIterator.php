<?php

namespace M20OnlineCore\Job;

use Iterator;

final class JobIterator implements Iterator
{
    private int $counter = 0;

    private array $data = [
        ClericJob::NAME,
        FighterJob::NAME,
        MagiJob::NAME,
        RogueJob::NAME
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