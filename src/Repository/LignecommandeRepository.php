<?php


namespace App\Repository;

use App\Entity\Lignecommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lignecommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lignecommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lignecommande[]    findAll()
 * @method Lignecommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LignecommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lignecommande::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Lignecommande $entity, bool $flush = true): void
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
    public function remove(Lignecommande $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findWithDefisByCommande($id){
        return $this->createQueryBuilder('l')
            ->where('l.idCommande = :id')
            ->setParameter('id', $id)
            ->innerJoin('l.idDefi', 'd')
            ->addSelect('d')
            ->getQuery()->getResult()
            ;
    }

}
