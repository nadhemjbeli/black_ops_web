<?php


namespace App\Repository;

use App\Entity\Champion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Champion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Champion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Champion[]    findAll()
 * @method Champion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChampionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Champion::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Champion $entity, bool $flush = true): void
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
    public function remove(Champion $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    /**
     * @return Champion[]
     */
    public function top3recent()

    { return $this->addchamp()
        ->orderBy('a.imageChamp', 'DESC')->setMaxResults(3)
        ->getQuery()
        ->getResult()
    ;
    }

    private function addchamp(QueryBuilder $qb = null)
    {
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('a.imageChamp IS NOT NULL');
    }
    private function getOrCreateQueryBuilder(QueryBuilder $qb = null)
    {
        return $qb ?: $this->createQueryBuilder('a');
    }

    public function championSameRole($role,$idjeu)

    {
        return $this->addchamp2()->where('a.roleChamp=:role')->setParameter('role',$role)

            ->andWhere('a.idJeu=:idjeu')
            ->setParameter('idjeu',$idjeu)
            ->orderBy('a.idChamp', 'ASC')
            ->getQuery()
            ->getResult()
            ;


//        $image=$this->createQueryBuilder('a')->groupBy('a.idJeu')->having('a.idImage=min(a.idImage)');
//        dd($image);

    }
    public function championSameDifficulty($difficulte,$idjeu)

    {
        return $this->addchamp3()->where('a.difficulteChamp=:difficulte')->setParameter('difficulte',$difficulte)
            ->andWhere('a.idJeu=:idjeu')
            ->setParameter('idjeu',$idjeu)
            ->orderBy('a.idChamp', 'ASC')
            ->getQuery()
            ->getResult()
            ;


//        $image=$this->createQueryBuilder('a')->groupBy('a.idJeu')->having('a.idImage=min(a.idImage)');
//        dd($image);

    }

    private function addchamp2(QueryBuilder $qb = null)
    {
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('a.roleChamp IS NOT NULL');
    }
    private function addchamp3(QueryBuilder $qb = null)
    {
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('a.difficulteChamp IS NOT NULL');
    }

}
