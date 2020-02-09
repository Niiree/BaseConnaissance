<?php

namespace App\Repository;


use App\Entity\Knowledgesheet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Knowledgesheet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Knowledgesheet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Knowledgesheet[]    findAll()
 * @method Knowledgesheet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KnowledgesheetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Knowledgesheet::class);
    }

    public function searchfultexte()
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT "ProjetBaseDeConnaissance".public.knowledgesheet.content
            FROM "ProjetBaseDeConnaissance".public.knowledgesheet
            WHERE to_tsvector(\'french\', content) @@ to_tsquery(\'french\', \'abandonner\')
    ');
        return $query;
    }
    // /**
    //  * @return Knowledgesheet[] Returns an array of Knowledgesheet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Knowledgesheet
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
