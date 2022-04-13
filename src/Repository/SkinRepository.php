<?php


namespace App\Repository;

use App\Entity\Skin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Skin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Skin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Skin[]    findAll()
 * @method Skin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Skin::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Skin $entity, bool $flush = true): void
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
    public function remove(Skin $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    public function toprecent()

    { return $this->addskin()
        ->orderBy('a.idSkin', 'DESC')->setMaxResults(6)
        ->getQuery()
        ->getResult()
        ;
    }

    private function addskin(QueryBuilder $qb = null)
    {
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('a.imageSkin IS NOT NULL');
    }
    private function getOrCreateQueryBuilder(QueryBuilder $qb = null)
    {
        return $qb ?: $this->createQueryBuilder('a');
    }
    public function maxidskin():int

    {   $entitymanager=$this->getEntityManager();
        $query=$entitymanager->createQuery('SELECT max(p.idSkin)+1 from App\Entity\Skin p ');
//        dd($query->getResult()[0][1]);
        return $query->getResult()[0][1];

    }
    public function maxidskin2():int

    {   $entitymanager=$this->getEntityManager();
        $query=$entitymanager->createQuery('SELECT max(p.idSkin) from App\Entity\Skin p ');
//        dd($query->getResult()[0][1]);
        return $query->getResult()[0][1];

    }
    public function Relatedskins ($id)
    {
        return $this->addskin()->where('a.idChamp=:id')->setParameter('id',$id)
            ->orderBy('a.idSkin', 'ASC')
            ->getQuery()
            ->getResult()
            ;


    }



}
