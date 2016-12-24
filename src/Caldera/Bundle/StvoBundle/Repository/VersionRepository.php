<?php

namespace Caldera\Bundle\StvoBundle\Repository;

use Caldera\Bundle\StvoBundle\Entity\Law;
use Caldera\Bundle\StvoBundle\Entity\Version;
use Doctrine\ORM\EntityRepository;

class VersionRepository extends EntityRepository
{
    public function findCurrentVersionForLaw(Law $law): ?Version
    {
        $qb = $this->createQueryBuilder('v');

        $qb
            ->where($qb->expr()->eq('v.law', $law->getId()))
            ->andWhere($qb->expr()->eq('v.draft', false))
            ->setMaxResults(1)
            ->orderBy('v.validFrom', 'DESC')
        ;

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }
}