<?php

namespace App\Repository;

use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Video>
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    public function findAllQueryBuilder() //on retourne le QueryBuilder (pas ->getQuery()->getResult()) pour que KnpPaginator exécute lui-même la requête avec LIMIT/OFFSET selon la page demandée
    {
        return $this->createQueryBuilder('v')
            ->orderBy('v.createdAt', 'DESC') //vidéos les plus récentes en premier
        ;
    }

    public function findBySearchQueryBuilder(string $search, bool $includePremium = false) //recherche sur title OU description, $includePremium détermine si les vidéos premium sont incluses (connecté + vérifié uniquement)
    {
        $queryBuilder = $this->createQueryBuilder('v')
            ->andWhere('v.title LIKE :search OR v.description LIKE :search')
            ->setParameter('search', '%' . $search . '%') //% autour du terme = recherche "contient", pas seulement "commence par"
            ->orderBy('v.createdAt', 'DESC');

        if (!$includePremium) {
            $queryBuilder->andWhere('v.premiumVideo = false'); //exclut les vidéos premium pour les non-vérifiés/non connectés
        }

        return $queryBuilder;
    }

    //    /**
    //     * @return Video[] Returns an array of Video objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Video
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}