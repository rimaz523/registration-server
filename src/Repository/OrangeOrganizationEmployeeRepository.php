<?php

namespace App\Repository;

use App\Entity\OrangeOrganizationEmployee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OrangeOrganizationEmployee|null find($instanceIdentifier, $lockMode = null, $lockVersion = null)
 * @method OrangeOrganizationEmployee|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrangeOrganizationEmployee[]    findAll()
 * @method OrangeOrganizationEmployee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrangeOrganizationEmployeeRepository extends ServiceEntityRepository
{
    
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OrangeOrganizationEmployee::class);
    }

    public function getLastEmployeeCountIncrement($instanceIdentifier)
    {
        $lastRecord = null;
        if ($instanceIdentifier) {
            $lastRecord = $this->createQueryBuilder('e')
                    ->andWhere('e.instanceIdentifier = :instanceIdentifier')
                    ->setParameter('instanceIdentifier', $instanceIdentifier)
                    ->andWhere('e.countType = :countType')
                    ->setParameter('countType', OrangeOrganizationEmployee::INCREMENT_COUNT_TYPE)
                    ->orderBy("e.date", "DESC")
                    ->getQuery()
                    ->setMaxResults(1)->getResult();
        }
        return $lastRecord;

    }
}
