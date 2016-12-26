<?php

namespace Caldera\Bundle\StvoBundle\StvoDiff;

use Caldera\Bundle\StvoBundle\StvoDiff\Lines\ChangedLine;
use Caldera\Bundle\StvoBundle\StvoDiff\Lines\UnchangedLine;

class DiffParagraph
{
    protected $lines = [];

    public function __construct()
    {

    }

    public function addUnchangedLine(string $text): DiffParagraph
    {
        $absatzNumber = $this->getAbsatzNumber($text);

        $line = new UnchangedLine($text);

        $this->lines[$absatzNumber] = $line;

        return $this;
    }

    public function addOldLine(string $text): DiffParagraph
    {
        $absatzNumber = $this->getAbsatzNumber($text);

        /** @var ChangedLine $changedLine */
        if (array_key_exists($absatzNumber, $this->lines)) {
            $changedLine = $this->lines[$absatzNumber];
            $changedLine->addOldLine($text);
        } else {
            $changedLine = new ChangedLine();
            $changedLine->addOldLine($text);
            $this->lines[$absatzNumber] = $changedLine;
        }

        return $this;
    }

    public function addNewLine(string $text): DiffParagraph
    {
        $absatzNumber = $this->getAbsatzNumber($text);

        /** @var ChangedLine $changedLine */
        if (array_key_exists($absatzNumber, $this->lines)) {
            $changedLine = $this->lines[$absatzNumber];
            $changedLine->addNewLine($text);
        } else {
            $changedLine = new ChangedLine();
            $changedLine->addNewLine($text);
            $this->lines[$absatzNumber] = $changedLine;
        }

        return $this;
    }

    protected function getAbsatzNumber(string $text): ?string
    {
        preg_match('/\(([0-9]{1,3}[a-z]?)\)/', $text, $matches);

        if (count($matches) === 2) {
            return $matches[1];
        }

        return null;
    }

    public function getLines(): array
    {
        return $this->lines;
    }
}