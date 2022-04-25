<?php


namespace App\Repository;

use App\Entity\Defi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Defi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Defi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Defi[]    findAll()
 * @method Defi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)

 */
class DefiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Defi::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Defi $entity, bool $flush = true): void
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
    public function remove(Defi $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findEntitiesByString($str)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Defi p
                WHERE p.nomDefi LIKE :str'
            )
            ->setParameter('str', '%' . $str . '%')
            ->getResult();
    }


    public function findByThree()
    {

        $qb = $this->createQueryBuilder('n');

        $qb->orderBy('n.idDefi', 'DESC')->setMaxResults(3);

        return $qb->getQuery()
            ->getResult();

    }
}