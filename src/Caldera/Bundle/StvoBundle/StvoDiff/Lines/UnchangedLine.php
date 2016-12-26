<?php

namespace Caldera\Bundle\StvoBundle\StvoDiff\Lines;

class UnchangedLine extends AbstractDiffLine
{
    protected $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function hasChanged(): bool
    {
        return false;
    }
}