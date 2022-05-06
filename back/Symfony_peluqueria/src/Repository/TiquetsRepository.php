<?php

namespace App\Repository;

use App\Entity\Tiquets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tiquets>
 *
 * @method Tiquets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tiquets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tiquets[]    findAll()
 * @method Tiquets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TiquetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Tiquets::class);
        $this->manager = $manager;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Tiquets $entity, bool $flush = true): void
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
    public function save($data_usuario, $fecha, $precio_total): void
    {
        $newTiquet = new Tiquets();

        $newTiquet
            ->setUsuario($data_usuario)
            ->setFecha($fecha)
            ->setPrecioTotal($precio_total);

        $this->manager->persist($newTiquet);
        $this->manager->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function coger_id_tiquet($id_usuario): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT Tiquets.id FROM Tiquets WHERE Tiquets.usuario_id = $id_usuario;";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save2($id2, $id,  $cantidades): void
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "INSERT INTO `Tiquets_Productos` (`tiquets_id`, `productos_id`,`cantidades`) VALUES ($id2, $id,  $cantidades);";
        $conn->prepare($sql);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Tiquets $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Tiquets[] Returns an array of Tiquets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tiquets
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
