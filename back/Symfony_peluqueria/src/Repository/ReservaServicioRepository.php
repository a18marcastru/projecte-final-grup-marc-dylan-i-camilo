<?php

namespace App\Repository;

use App\Entity\ReservaServicio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Void_;

/**
 * @extends ServiceEntityRepository<ReservaServicio>
 *
 * @method ReservaServicio|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservaServicio|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservaServicio[]    findAll()
 * @method ReservaServicio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservaServicioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, ReservaServicio::class);
        $this->manager = $manager;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ReservaServicio $entity, bool $flush = true): void
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
    public function coger_id_reserva_servicio($id): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT reserva_servicio.* FROM reserva_servicio WHERE reserva_servicio.reserva_id = $id;";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function coger_reserva_servicio($id): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT reservas.dia, reservas.hora, reservas.mes, reservas.precio_total, usuarios.telefono, usuarios.email, servicios.nombre_servicio 
                FROM reservas join usuarios on reservas.usuario_id=usuarios.id join reserva_servicio on reservas.id=reserva_servicio.reserva_id 
                join servicios on servicios.id = reserva_servicio.servicio_id WHERE usuario_id=$id;";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save($data_reserva, $data_servicio): void
    {
        $newReservaServicio = new ReservaServicio();

        $newReservaServicio
            ->setReserva($data_reserva)
            ->setServicio($data_servicio);

        $this->manager->persist($newReservaServicio);
        $this->manager->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ReservaServicio $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ReservaServicio[] Returns an array of ReservaServicio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReservaServicio
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
