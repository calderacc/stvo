<?php

namespace Caldera\Bundle\StvoBundle\StvoDiff\Lines;

class ChangedLine
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
        $this->newLines = $newLine;

        return $this;
    }
}