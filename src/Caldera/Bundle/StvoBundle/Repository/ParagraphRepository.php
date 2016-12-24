<?php

namespace Caldera\Bundle\StvoBundle\Repository;

use Caldera\Bundle\StvoBundle\Entity\Law;
use Caldera\Bundle\StvoBundle\Entity\Paragraph;
use Caldera\Bundle\StvoBundle\Entity\Version;
use Doctrine\ORM\EntityRepository;

class ParagraphRepository extends EntityRepository
{
    public function findByVersion(Version $version): array
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->where($qb->expr()->eq('p.version', $version->getId()))
        ;

        $qb->orderBy('p.number', 'ASC');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function findOneByVersionNumber(Version $version, string $number): ?Paragraph
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->where($qb->expr()->eq('p.version', $version->getId()))
            ->andWhere($qb->expr()->eq('p.number', '\'' . $number . '\''))
        ;

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }
}