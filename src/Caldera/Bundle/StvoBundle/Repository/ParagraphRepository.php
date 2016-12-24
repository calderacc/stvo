<?php

namespace Caldera\Bundle\StvoBundle\Repository;

use Caldera\Bundle\StvoBundle\Entity\Law;
use Caldera\Bundle\StvoBundle\Entity\Paragraph;
use Doctrine\ORM\EntityRepository;

class ParagraphRepository extends EntityRepository
{
    public function getOneByLawVersion(Law $law, $version): ?Paragraph
    {

    }
}