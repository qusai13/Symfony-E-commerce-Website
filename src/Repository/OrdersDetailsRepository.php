<?php

namespace App\Repository;

use App\Entity\OrdersDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OrdersDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdersDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdersDetails[]    findAll()
 * @method OrdersDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersDetailsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OrdersDetails::class);
    }
    public function findwithproduct($id): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT orders_details.*,products.image as img, products.description as descrip from orders_details  left join products on orders_details.pid = products.id where orders_details.orderid=:id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(["id"=>$id]);
        return $stmt->fetchAll();
    }

//    /**
//     * @return OrdersDetails[] Returns an array of OrdersDetails objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrdersDetails
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
