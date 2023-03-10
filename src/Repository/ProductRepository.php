<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Product
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function myFindAll()
    {
        $em = $this->getEntityManager();
        $req = $em->createQuery('select p.name from App\Entity\Product p');
        return $req->getResult();
    }

    public function findByCategory($cat)
    {
        $em = $this->getEntityManager();
        $req = $em->createQuery('select p.name from App\Entity\Product p join p.cat c where c.name=:m');
        $req->setParameter('m', $cat);
        return $req->getResult();
    }
    public function findAllByQB()
    {
        $champ = true;
        $req =  $this->createQueryBuilder('p') //select * from product
            ->select('p.name');
        if ($champ == true) {
            $req->join('p.cat', 't')
                ->addSelect('t.name y')
                ->where("t.name='mobile'");
        }
        $res = $req->getQuery()->getResult();
        return $res;
    }

    public function findByCategoryQB($category)
    {

        $req =  $this->createQueryBuilder('p') //select * from product
            //->select('p.name');

            ->join('p.cat', 't')
            ->Select('t.name y')
            ->where("t.name=:m")
            ->setParameter(':m', $category)
            ->getQuery()
            ->getResult();
            dd($req);
        return $req;
    }
}
