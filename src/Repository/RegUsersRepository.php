<?php

namespace App\Repository;

use App\Entity\RegUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RegUsers|null find($instanceIdentifier, $lockMode = null, $lockVersion = null)
 * @method RegUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegUsers[]    findAll()
 * @method RegUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegUsersRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, RegUsers::class);
    }

    /**
     * @return RegUsers[] Returns an array of RegUsers objects
     */
    public function searchRegisteredUsers(array $searchParameters, $getCount = false) {
        $query = $this->createQueryBuilder('r');
        if (isset($searchParameters['company']) && !empty($searchParameters['company'])) {
            $query->andWhere('r.company LIKE :company')
                    ->setParameter('company', '%' . $searchParameters['company'] . '%');
        }
        if (isset($searchParameters['countryCode']) && !empty($searchParameters['countryCode'])) {
            $query->andWhere('r.countryCode = :countryCode')
                    ->setParameter('countryCode', $searchParameters['countryCode']);
        }
        if ($getCount) {
            $result = count($query->getQuery()->getResult());
        } else {
            $orderField = isset($searchParameters['orderBy']['field']) && !empty($searchParameters['orderBy']['field']) ? $searchParameters['orderBy']['field'] : 'date';
            $order = isset($searchParameters['orderBy']['order']) && !empty($searchParameters['orderBy']['order']) ? $searchParameters['orderBy']['order'] : 'DESC';
            $query->orderBy("r.$orderField", $order);
            if (isset($searchParameters['isExport']) && !$searchParameters['isExport']) {
                $query->setFirstResult(isset($searchParameters['offset']) && !empty($searchParameters['offset']) ? $searchParameters['offset'] : null);
                $query->setMaxResults(isset($searchParameters['limit']) && !empty($searchParameters['limit']) ? $searchParameters['limit'] : null);
            }
            $result = $query->getQuery()->getResult();
        }
        return $result;
    }

}
