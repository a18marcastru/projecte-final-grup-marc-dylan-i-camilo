<?php

namespace App\Repository;

use App\Entity\TicketProducto;
use App\Entity\Tickets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TicketProducto>
 *
 * @method TicketProducto|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketProducto|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketProducto[]    findAll()
 * @method TicketProducto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, TicketProducto::class);
        $this->manager = $manager;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(TicketProducto $entity, bool $flush = true): void
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
    public function coger_compras($id): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT tickets.fecha, tickets.precio_total, usuarios.email, usuarios.telefono, ticket_producto.cantidades, productos.nombre 
                FROM tickets join usuarios on tickets.usuario_id=usuarios.id join ticket_producto on tickets.id=ticket_producto.ticket_id 
                join productos on productos.id = ticket_producto.producto_id WHERE usuario_id=$id; ";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save($data_ticket, $data_producto,  $data_cantidades): void
    {
        $newComprar = new TicketProducto();

        $newComprar
            ->setTicket($data_ticket)
            ->setProducto($data_producto)
            ->setCantidades($data_cantidades);

        $this->manager->persist($newComprar);
        $this->manager->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(TicketProducto $entity, bool $flush = true): void
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
