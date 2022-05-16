<?php

namespace App\Repository;

use App\Entity\Material;
use App\Entity\Persona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Persona|null find($id, $lockMode = null, $lockVersion = null)
 * @method Persona|null findOneBy(array $criteria, array $orderBy = null)
 * @method Persona[]    findAll()
 * @method Persona[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Persona::class);
    }

    public function create() : Persona{
        $persona = new Persona();
        $this->getEntityManager()->persist($persona);
        return $persona;
    }

    public function save() : void
    {
        $this->getEntityManager()->flush();
    }

    public function remove(Persona $persona) : void{
        $this->getEntityManager()->remove($persona);
        $this->save();
    }

    public function findUsariosOrdenadosApellidoNombreConMaterialResponsable() :array{
        return $this->createQueryBuilder('u')
            ->innerJoin(Material::class, 'm', Join::WITH, 'u.id = m.responsable')
            ->orderBy('u.apellidos', 'ASC')
            ->addOrderBy('u.nombre', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @throws ORMException
//     * @throws OptimisticLockException
//     */
//    public function add(Persona $entity, bool $flush = true): void
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
//    public function remove(Persona $entity, bool $flush = true): void
//    {
//        $this->_em->remove($entity);
//        if ($flush) {
//            $this->_em->flush();
//        }
//    }

    // /**
    //  * @return Persona[] Returns an array of Persona objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Persona
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
