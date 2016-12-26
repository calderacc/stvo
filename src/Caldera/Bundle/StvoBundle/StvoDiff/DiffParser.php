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
        $tmpAbsatzNumber = null;

        for ($i = 0; $i < count($lines); ++$i) {
            $line = $lines[$i];

            if (strlen($line)) {
                if (strpos($line, '- ') === 0) {
                    if (!$tmpChangedLine) {
                        $tmpChangedLine = new ChangedLine();
                        $tmpAbsatzNumber = $this->getAbsatzNumber($line);
                    }

                    if ($this->getAbsatzNumber($line) !== $tmpAbsatzNumber)  {
                        $this->lines[] = $tmpChangedLine;
                        $tmpChangedLine = new ChangedLine();
                    }

                    $line = str_replace('- ', '', $line);
                    $tmpChangedLine->addOldLine($line);
                } elseif (strpos($line, '+ ') === 0) {
                    if (!$tmpChangedLine) {
                        $tmpChangedLine = new ChangedLine();
                        $tmpAbsatzNumber = $this->getAbsatzNumber($line);
                    }

                    if ($this->getAbsatzNumber($line) !== $tmpAbsatzNumber)  {
                        $this->lines[] = $tmpChangedLine;
                        $tmpChangedLine = new ChangedLine();
                    }

                    $line = str_replace('+ ', '', $line);
                    $tmpChangedLine->addNewLine($line);
                } elseif (
                    strpos($line, '---') !== 0 &&
                    strpos($line, '+++') !== 0 &&
                    strpos($line, '@@') !== 0 &&
                    !empty($line)
                ) {
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

    protected function getAbsatzNumber(string $text): ?string
    {
        preg_match('/\(([0-9]{1,3}[a-z]?)\)/', $text, $matches);

        if (count($matches) === 2) {
            return $matches[1];
        }

        return null;
    }
}