<?php

namespace App\Repository;


use App\Entity\Knowledgesheet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
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
// Requete de recherche full texte
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('App\\Entity\\Knowledgesheet', "p");
        $sql = <<<SQL
         SELECT id, ts_headline(content, plainto_tsquery('french', :search)) as content, title
         FROM knowledgesheet 
         WHERE to_tsvector('french', content) @@ plainto_tsquery('french', :search)
SQL;
        $query = $this->_em->createNativeQuery($sql,$rsm);
        $query->setParameter('search', $search);
        return $result = $query->getResult();



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
