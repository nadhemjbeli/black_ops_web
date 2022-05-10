<?php

namespace App\Repository;

use App\Entity\LikeMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LikeMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikeMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikeMessage[]    findAll()
 * @method LikeMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikeMessage::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(LikeMessage $entity, bool $flush = true): void
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
    public function remove(LikeMessage $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function countLikes($idMessage)
    {
        $qb = $this->createQueryBuilder('l')
            ->where('l.idMessage = :id')
            ->setParameter('id', $idMessage)
            ->select('sum(l.react) as count');
        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $idCl
     * @param $idMessage
     * @return LikeMessage
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findLikeByUserAndMessage($idCl, $idMessage){
        $qb = $this->createQueryBuilder('l')
            ->where('l.idMessage = :idMessage')
            ->setParameter('idMessage', $idMessage)
            ->andWhere('l.idCl = :idCl')
            ->setParameter('idCl', $idCl);
        return $qb->getQuery()->getOneOrNullResult();

    }

    // /**
    //  * @return LikeMessage[] Returns an array of LikeMessage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LikeMessage
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
