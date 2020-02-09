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

    public function searchfultexte($search)
    {
         $builder = $this->_em->createQueryBuilder() //build la requeteQuery avec la source et le select
             ->select('id')
             ->where("id = $search") // Condition de notre recherche
         ->from($this->_entityName,'id');
         $query = $builder ->getQuery(); //Récuperation de la query dans $query
         $result = $query ->getResult(); //Récupération du résultat pour le retourner
        return $result;
    }


    //
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
