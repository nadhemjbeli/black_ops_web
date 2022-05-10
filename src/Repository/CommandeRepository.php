<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Commande $entity, bool $flush = true): void
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
    public function remove(Commande $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    TODO: jointure commandes et users
    public function findCommandeByUsers(){
        $qb = $this->createQueryBuilder('c')
            ->join('c.idCl', 'u')
            ->addSelect('u')

        ;
        return $qb->getQuery()->getResult();
    }


    public function findMaxCommandeByUser($id)
    {
        /** @var int $idComm */
        $idComm = $this->createQueryBuilder('c')
            ->where('c.etatCommande = :etat')
            ->setParameter('etat', 'en cours')
            ->orderBy('c.idCommande', 'DESC')
            ->setMaxResults(1)
            ->select('c.idCommande')
            ->getQuery()->getOneOrNullResult();
//        dd($qb1);
        if($idComm){
            return $this->createQueryBuilder('c')
                ->where('c.idCl = :id')
                ->setParameter('id', $id)
                ->andWhere('c.idCommande = :idComm')
                ->setParameter('idComm', $idComm)
                ->getQuery()->getOneOrNullResult()
                ;
        }
        return null;

    }

    // /**
    //  * @return Commande[] Returns an array of Commande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commande
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
