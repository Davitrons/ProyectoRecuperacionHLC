<?php

namespace App\Repository;

use App\Entity\Localizacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Localizacion>
 *
 * @method Localizacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Localizacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Localizacion[]    findAll()
 * @method Localizacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocalizacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Localizacion::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Localizacion $entity, bool $flush = true): void
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
    public function remove(Localizacion $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Localizacion[] Returns an array of Localizacion objects
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
    public function findOneBySomeField($value): ?Localizacion
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByPadre(?Localizacion $padre)
    {
        $qb = $this->createQueryBuilder('l')
            ->select('l, h')
            ->leftJoin('l.hijos', 'h')
            ->orderBy('l.nombre')
            ->addOrderBy('l.codigo');

        if ($padre) {
            $qb
                ->where('l.padre = :padre')
                ->setParameter('padre', $padre);
        } else {
            $qb
                ->where('l.padre IS NULL');
        }

        return $qb
            ->getQuery()
            ->getResult();
    }

    public function findOrdenados()
    {
        return $this->createQueryBuilder('l')
            ->select('l, h, p')
            ->leftJoin('l.padre', 'p')
            ->leftJoin('l.hijos', 'h')
            ->orderBy('p.codigo')
            ->addOrderBy('l.codigo')
            ->getQuery()
            ->getResult();
    }
}
