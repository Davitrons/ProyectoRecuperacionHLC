<?php

namespace App\Repository;

use App\Entity\Localizacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
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

    public function create() : Localizacion{
        $localizacion = new Localizacion();
        $this->getEntityManager()->persist($localizacion);
        return $localizacion;
    }

    public function save() : void
    {
        $this->getEntityManager()->flush();
    }

    public function remove(Localizacion $localizacion) : void{
        $this->getEntityManager()->remove($localizacion);
        $this->save();
    }

    public function findAllLocalizaciones() : array{
        return $this->createQueryBuilder('l')
            ->getQuery()
            ->getResult();
    }

    public function findLocalizacionSinPadre() : array{
        return $this->createQueryBuilder('l')
            ->where('l.padre is NULL')
            ->getQuery()
            ->getResult();
    }

    public function findLocalizacionesHijas(?Localizacion $localizacion) : array{
        $qb = $this->createQueryBuilder('h');

        if ($localizacion){
            $qb
                ->where('h.padre = :localizacion')
                ->setParameter('localizacion', $localizacion);
        }
        return $qb
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @throws ORMException
//     * @throws OptimisticLockException
//     */
//    public function add(Localizacion $entity, bool $flush = true): void
//    {
//        $this->_em->persist($entity);
//        if ($flush) {
//            $this->_em->flush();
//        }
//    }
//
//    /**
//     * @throws ORMException
//     * @throws OptimisticLockException
//     */
//    public function remove(Localizacion $entity, bool $flush = true): void
//    {
//        $this->_em->remove($entity);
//        if ($flush) {
//            $this->_em->flush();
//        }
//    }

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
}
