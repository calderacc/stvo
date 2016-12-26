<?php

namespace Caldera\Bundle\StvoBundle\StvoDiff;

class DiffParser
{
    protected $diff;
    protected $diffParagraph;

    public function __construct(string $diff)
    {
        $this->diff = $diff;
        $this->diffParagraph = new DiffParagraph();
    }

    public function parse()
    {
        $lines = explode("\n", $this->diff);

        for ($i = 0; $i < count($lines); ++$i) {
            $line = $lines[$i];

            if (strlen($line)) {
                if (strpos($line, '- ') === 0) {
                    $this->diffParagraph->addOldLine($line);
                } elseif (strpos($line, '+ ') === 0) {
                    $this->diffParagraph->addNewLine($line);
                } elseif (
                    strpos($line, '---') !== 0 &&
                    strpos($line, '+++') !== 0 &&
                    strpos($line, '@@') !== 0 &&
                    !empty($line)
                ) {
                    $this->diffParagraph->addUnchangedLine($line);
                }
            }
        }
    }

    public function getDiffedLines(): array
    {
        return $this->diffParagraph->getLines();
    }
}