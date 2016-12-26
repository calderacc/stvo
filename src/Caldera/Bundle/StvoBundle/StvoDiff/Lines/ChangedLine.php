<?php

namespace Caldera\Bundle\StvoBundle\StvoDiff\Lines;

class ChangedLine extends AbstractDiffLine
{
    protected $oldLines = [];
    protected $newLines = [];

    public function __construct()
    {
    }

    public function addOldLine(string $oldLine): ChangedLine
    {
        $this->oldLines[] = $oldLine;

        return $this;
    }

    public function addNewLine(string $newLine): ChangedLine
    {
        $this->newLines[] = $newLine;

        return $this;
    }

    public function getOldLines(): array
    {
        return $this->oldLines;
    }

    public function getNewLines(): array
    {
        return $this->newLines;
    }

    public function hasChanged(): bool
    {
        return true;
    }
}