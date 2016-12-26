<?php

namespace Caldera\Bundle\StvoBundle\StvoDiff\Lines;

class UnchangedLine
{
    protected $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }
}