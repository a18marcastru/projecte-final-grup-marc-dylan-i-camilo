<?php

namespace App\Repository;

use App\Entity\Comprar;
use App\Entity\Tickets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comprar>
 *
 * @method Comprar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comprar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comprar[]    findAll()
 * @method Comprar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComprarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Comprar::class);
        $this->manager = $manager;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Comprar $entity, bool $flush = true): void
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
    public function save($data_ticket, $data_producto,  $cantidades): void
    {
        $newComprar = new Comprar();

        $newComprar
            ->setTicket($data_ticket)
            ->setProducto($data_producto)
            ->setCantidades($cantidades);

        $this->manager->persist($newComprar);
        $this->manager->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Comprar $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Comprar[] Returns an array of Comprar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comprar
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
