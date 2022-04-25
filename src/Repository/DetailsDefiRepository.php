<?php


namespace App\Repository;

use App\Entity\DetailsDefi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetailsDefi|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailsDefi|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailsDefi[]    findAll()
 * @method DetailsDefi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailsDefiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailsDefi::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(DetailsDefi $entity, bool $flush = true): void
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
    public function remove(DetailsDefi $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }




    public function DateDataBase()
    {
        $curent = new \DateTime();
        $av = new \DateTime();
        $av ->modify('+ 1 hours');
        $av ->modify('-45 minutes');
        $curent ->modify('+ 1 hours');
        $qb = $this->createQueryBuilder('n');
        $qb->where('n.date <= :curent')->andWhere('n.date>= :av')
        ->orderBy('n.date','DESC')
        ->setParameter('curent',$curent)->setParameter('av',$av);

        return $qb->getQuery()
            ->getResult();
    }
    public function TopThree()
    {
        $curent = new \DateTime();
        $av = new \DateTime();
        $av ->modify('+ 1 hours');
        $av ->modify('-24 hours');
        $curent ->modify('+ 1 hours');
        $qb = $this->createQueryBuilder('n');
        $qb->where('n.date <= :curent')->andWhere('n.date>= :av')
            ->orderBy('n.date','DESC')
            ->setParameter('curent',$curent)->setParameter('av',$av);

        return $qb->getQuery()
            ->getResult();
    }
    public function Upcoming()
    {
        $curent = new \DateTime();
        $av = new \DateTime();
        $av ->modify('+ 1 hours');
        $av ->modify('+12 hours');
        $curent ->modify('+1 hours');
        $curent ->modify('+45 minutes');
        $qb = $this->createQueryBuilder('n');
        $qb->where('n.date >= :curent')->andWhere('n.date<= :av')
            ->orderBy('n.date','DESC')->setMaxResults(2)
            ->setParameter('curent',$curent)->setParameter('av',$av);

        return $qb->getQuery()
            ->getResult();
    }
    public function Live()
    {
        $curent = new \DateTime();
        $av = new \DateTime();
        $av ->modify('+ 1 hours');
        $av ->modify('-45 minutes');
        $curent ->modify('+ 1 hours');
        $qb = $this->createQueryBuilder('n');
        $qb->where('n.date <= :curent')->andWhere('n.date>= :av')
            ->orderBy('n.date','DESC')->setMaxResults(1)
            ->setParameter('curent',$curent)->setParameter('av',$av);

        return $qb->getQuery()
            ->getResult();
    }
}