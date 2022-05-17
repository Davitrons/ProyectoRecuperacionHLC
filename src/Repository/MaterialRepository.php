<?php

namespace App\Repository;

use App\Entity\Localizacion;
use App\Entity\Material;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Material|null find($id, $lockMode = null, $lockVersion = null)
 * @method Material|null findOneBy(array $criteria, array $orderBy = null)
 * @method Material[]    findAll()
 * @method Material[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Material::class);
    }

//    public function create() : Material{
//        $material = new Material();
//        $this->getEntityManager()->persist($material);
//        return $material;
//    }
//
//    public function save() : void
//    {
//        $this->getEntityManager()->flush();
//    }
//
//    public function remove(Material $material) : void{
//        $this->getEntityManager()->remove($material);
//        $this->save();
//    }

    public function findbyLocalizacion(?Localizacion $localizacion) : array{
        $qb = $this->createQueryBuilder('m');

        if ($localizacion){
            $qb
                ->where('m.localizacion = :localizacion')
                ->setParameter('localizacion', $localizacion);
        }
        return $qb
            ->getQuery()
            ->getResult();
    }

    public function findMaterialesPrestados() : array{
        return $this->createQueryBuilder('mp')
            ->where('mp.disponible = 0')
            ->orderBy('mp.fechaHoraUltimoPrestamo', 'ASC')
            ->getQuery()
            ->getResult();
    }



//    /**
//     * @throws ORMException
//     * @throws OptimisticLockException
//     */
//    public function add(Material $entity, bool $flush = true): void
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
//    public function remove(Material $entity, bool $flush = true): void
//    {
//        $this->_em->remove($entity);
//        if ($flush) {
//            $this->_em->flush();
//        }
//    }

    // /**
    //  * @return Material[] Returns an array of Material objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Material
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
