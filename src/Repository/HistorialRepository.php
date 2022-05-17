<?php

namespace App\Repository;

use App\Entity\Historial;
use App\Entity\Material;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use http\Env\Response;

/**
 * @method Historial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Historial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Historial[]    findAll()
 * @method Historial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistorialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Historial::class);
    }

    public function create() : Historial{
        $historial = new Historial();
        $this->getEntityManager()->persist($historial);
        return $historial;
    }

    public function save() : void
    {
        $this->getEntityManager()->flush();
    }

    public function remove(Historial $historial) : void{
        $this->getEntityManager()->remove($historial);
        $this->save();
    }

    public function findHistorial(?Material $material) : array{
        $qb = $this->createQueryBuilder('h');

        if ($material){
            $qb
                ->where('h.material = :material')
                ->orderBy('h.fechaHoraPrestamo' , 'ASC')
                ->setParameter('material', $material);
        }
        return $qb
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @throws ORMException
//     * @throws OptimisticLockException
//     */
//    public function add(Historial $entity, bool $flush = true): void
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
//    public function remove(Historial $entity, bool $flush = true): void
//    {
//        $this->_em->remove($entity);
//        if ($flush) {
//            $this->_em->flush();
//        }
//    }

    // /**
    //  * @return Historial[] Returns an array of Historial objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Historial
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
