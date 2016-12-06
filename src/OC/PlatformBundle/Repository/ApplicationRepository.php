<?php
/**
 * Created by PhpStorm.
 * User: Mido
 * Date: 02/12/2016
 * Time: 16:13
 */
namespace OC\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ApplicationRepository extends EntityRepository
{
    public function getApplicationsWithAdvert($limit)
    {
        $qb = $this->createQueryBuilder('a');

        // On fait une jointure avec l'entité Advert avec pour alias « adv »
        $qb
            ->innerJoin('a.advert', 'adv')
            ->addSelect('adv')
        ;

        // Puis on ne retourne que $limit résultats
        $qb->setMaxResults($limit);

        // Enfin, on retourne le résultat
        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}


