<?php

namespace App\Repository;

use App\Entity\Formation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formation[]    findAll()
 * @method Formation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formation::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Formation $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Formation $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function findByFight($id_fight)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT formation_id
            FROM formation_fight f
            WHERE f.fight_id = :id_fight
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['id_fight' => $id_fight]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findByFormation($id_user)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT formation.name, formation.id
            FROM formation f, user u
            WHERE u.id = :id_user
            AND f.user_id = u.id
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['id_user' => $id_user]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }    


    public function findIdByUser($id_user)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT f.id
        FROM formation f, user u
        WHERE u.id = :id_user
        AND f.user_id = u.id
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['id_user' => $id_user]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }


    // /**
    //  * @return Formation[] Returns an array of Formation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Formation
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
