<?php

namespace App\Repository;

use App\Entity\Comentarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comentarios>
 *
 * @method Comentarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comentarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comentarios[]    findAll()
 * @method Comentarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComentariosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Comentarios::class);
        $this->manager = $manager;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Comentarios $entity, bool $flush = true): void
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
    public function save($data_usuario, $descripcion, $valoracion): void
    {
        $newComentario = new Comentarios();

        $newComentario
            ->setUsuario($data_usuario)
            ->setDescripcion($descripcion)
            ->setValoracion($valoracion);

        $this->manager->persist($newComentario);
        $this->manager->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function mostrarComentarios(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT Comentarios.descripcion, Comentarios.valoracion, Comentarios.usuario_id FROM Comentarios WHERE Comentarios.valoracion BETWEEN 4 AND 5;";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Comentarios $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Comentarios[] Returns an array of Comentarios objects
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
    public function findOneBySomeField($value): ?Comentarios
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
