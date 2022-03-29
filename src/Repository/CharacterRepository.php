<?php

namespace App\Repository;

use App\Entity\Character;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security as CoreSecurity;

/**
 * @method Character|null find($id, $lockMode = null, $lockVersion = null)
 * @method Character|null findOneBy(array $criteria, array $orderBy = null)
 * @method Character[]    findAll()
 * @method Character[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterRepository extends ServiceEntityRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Character::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Character $entity, bool $flush = true): void
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
    public function remove(Character $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function findByFormation($id_formation)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT characters_id
            FROM character_formation c
            WHERE c.formations_id = :id_formation
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['id_formation' => $id_formation]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findPremade()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
                SELECT * 
                FROM `character` 
                WHERE `user_id` is null 
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function RestToFormate()
    {
        $conn = $this->getEntityManager()->getConnection();


        $sql = '
        SELECT *
        FROM `character`
        WHERE `character`.user_id = :id_user
        AND `character`.id NOT IN (
            SELECT `character_formation`.`characters_id` FROM `character_formation`
        );
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['id_user' => 2]);

        // returns an array of arrays (i.e. a raw data set)
        dd($resultSet->fetchAllAssociative());
        return $resultSet->fetchAllAssociative();
        //$tab_characters[] = '';
        foreach ($resultSet->fetchAllAssociative() as $key_character) {

            $var_character = $key_character['id'];
            $req_character = $this->find($var_character);
            /*
            $var_character = new Character();
            $var_character->setName($key_character['name'])
                ->setLevel($key_character['level'])
                ->setAttack($key_character['attack'])
                ->setDefense($key_character['defense'])
                ->setResistance($key_character['resistance'])
                ->setSpeed($key_character['speed'])
                ->setUser($this->security->getUser())
                ->setIspremade(0);
            */
            $tab_characters[] = $req_character;
        }
        //dd($tab_characters);
        //return $tab_characters;
    }

    // /**
    //  * @return Character[] Returns an array of Character objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Character
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
