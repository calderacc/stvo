<?php

namespace Caldera\Bundle\StvoBundle\StvoDiff\Lines;

abstract class AbstractDiffLine
{
    abstract public function hasChanged(): bool;
}