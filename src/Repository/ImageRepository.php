<?php


namespace App\Repository;

use App\Entity\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Image|null find($id, $lockMode = null, $lockVersion = null)
 * @method Image|null findOneBy(array $criteria, array $orderBy = null)
 * @method Image[]    findAll()
 * @method Image[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Image $entity, bool $flush = true): void
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
    public function remove(Image $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    /**
     * @return Image[]
     */
    public function firstimgbyjeu()

    {
       return $this->addimage()->groupBy('a.idJeu')
        ->orderBy('a.idImage', 'ASC')
        ->getQuery()
        ->getResult()
    ;


//        $image=$this->createQueryBuilder('a')->groupBy('a.idJeu')->having('a.idImage=min(a.idImage)');
//        dd($image);

    }

    private function addimage(QueryBuilder $qb = null)
    {
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('a.urlImage IS NOT NULL');
    }
    private function getOrCreateQueryBuilder(QueryBuilder $qb = null)
    {
        return $qb ?: $this->createQueryBuilder('a');
    }
    public function maxidimg():int

    {   $entitymanager=$this->getEntityManager();
        $query=$entitymanager->createQuery('SELECT max(p.idImage)+1 from App\Entity\Image p ');
//        dd($query->getResult()[0][1]);
        return $query->getResult()[0][1];

    }
    public function maxidimg2():int

    {   $entitymanager=$this->getEntityManager();
        $query=$entitymanager->createQuery('SELECT max(p.idImage) from App\Entity\Image p ');
//        dd($query->getResult()[0][1]);
        return $query->getResult()[0][1];

    }
    public function search($nom)
    {   return $this->createQueryBuilder('a')
        ->where('a.urlImage LIKE :nom')
        ->setParameter('nom','%'.$nom.'%')
        ->getQuery()->getResult();

    }

    public function searchGame($nom)
    {   return $this->createQueryBuilder('a')
        ->innerJoin('a.idJeu','c')
        ->addSelect('c')
        ->groupBy('a.idJeu')
        ->orderBy('a.idImage', 'ASC')

        ->where('c.nom LIKE :nom')
        ->setParameter('nom','%'.$nom.'%')
        ->getQuery()
        ->getResult()
        ;
    }
}