<?php

namespace Caldera\Bundle\StvoBundle\StvoDiff;

use Caldera\Bundle\StvoBundle\StvoDiff\Lines\ChangedLine;
use Caldera\Bundle\StvoBundle\StvoDiff\Lines\UnchangedLine;

class DiffParser
{
    protected $diff;
    protected $lines = [];

    public function __construct(string $diff)
    {
        $this->diff = $diff;
    }

    public function parse()
    {
        $lines = explode("\n", $this->diff);

        /** @var ChangedLine $tmpChangedLine */
        $tmpChangedLine = null;

        for ($i = 0; $i < count($lines); ++$i) {
            $line = $lines[$i];

            if (strlen($line)) {
                if (strpos($line, '- ') === 0) {
                    if (!$tmpChangedLine) {
                        $tmpChangedLine = new ChangedLine();
                    }

                    $tmpChangedLine->addOldLine($line);
                } elseif (strpos($line, '+ ') === 0) {
                    if (!$tmpChangedLine) {
                        $tmpChangedLine = new ChangedLine();
                    }

                    $tmpChangedLine->addNewLine($line);
                } else {
                    if ($tmpChangedLine) {
                        $this->lines[] = $tmpChangedLine;
                        $tmpChangedLine = null;
                    }

                    $this->lines[] = new UnchangedLine($line);
                }
            }
        }

        if ($tmpChangedLine) {
            $this->lines[] = $tmpChangedLine;
            $tmpChangedLine = null;
        }
    }

    public function getDiffedLines(): array
    {
        return $this->lines;
    }
}