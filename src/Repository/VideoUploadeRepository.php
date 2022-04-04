<?php


namespace App\Repository;

use App\Entity\VideoUploade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VideoUploade|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoUploade|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoUploade[]    findAll()
 * @method VideoUploade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoUploadeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoUploade::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VideoUploade $entity, bool $flush = true): void
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
    public function remove(VideoUploade $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

}
