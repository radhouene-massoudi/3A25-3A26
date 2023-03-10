<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/fetchProduct', name: 'fetchProduct')]
    public function fetchProduct(ManagerRegistry $mg): Response
    {
        $products=$mg->getRepository(Product::class)->findAll();
        //dd($products);
        return $this->render('product/products.html.twig', [
            'p' => $products,
        ]);
    }
    #[Route('/remove/{id}', name: 'remove')]
    public function remove(ManagerRegistry $mg,$id,ProductRepository $repo): Response
    {
        $product=$repo->find($id);
        $em=$mg->getManager();
        $em->remove($product);
        $em->flush();
               
        return new Response('removed');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(ManagerRegistry $mg,Product $p): Response
    {
       
        $em=$mg->getManager();
        $em->remove($p);
        $em->flush();
               
        return new Response('removed');
    }

    #[Route('/addProduct', name: 'addProduct')]
    public function addProduct(ManagerRegistry $mr, Request $req)
    {
      $p=new Product(); 

      $f=$this->createForm(ProductType::class,$p);
      $f->handleRequest($req);
      
      if($f->isSubmitted()){
        //dd($req);
        $p->setDate(new \DateTimeImmutable('now'));
      $em=$mr->getManager();
      $em->persist($p);
      $em->flush();
      return $this->redirectToRoute('fetchProduct');
    }
    return $this->render('product/addproduct.html.twig', [
        'for' => $f->createView(),
    ]);
      
    }
    #[Route('/updateProduct/{id}', name: 'updateProduct')]
    public function updateProduct(ManagerRegistry $mr, Request $req,$id)
    {
      //$p=new Product(); 
      $p=$mr->getRepository(Product::class)->find($id);

      $f=$this->createForm(ProductType::class,$p);
      $f->handleRequest($req);
      
      if($f->isSubmitted()){
        //dd($req);
        $p->setDate(new \DateTimeImmutable('now'));
      $em=$mr->getManager();
     // $em->persist($p);
      $em->flush();
      return $this->redirectToRoute('fetchProduct');
    }
    return $this->renderForm('product/addProduct.html.twig', [
        'for' => $f,
    ]);
      
    }

    #[Route('/selectALL', name: 'selectALL')]
    public function findAllFromProduct(EntityManagerInterface $em)
    {
        /*req sql select * from product
        $req=$em->createQuery('select p.name,c.name t from App\Entity\Product p join p.cat c');
        $result=$req->getResult();
        dd($result);

        $req=$em->createQuery('select count(p) from App\Entity\Product p join p.cat c');
        $result=$req->getSingleScalarResult();
        dd($result);*/

        $req=$em->createQuery("select p.name,c.name t from App\Entity\Product p join p.cat c where c.name=?1 ");
       $req->setParameter('1','tv');
        $result=$req->getResult();
        dd($result);
    }

    #[Route('/myfindall', name: 'myfindall')]
    public function myfindall(ProductRepository $repo)
    {

        $result=$repo->findByCategoryQB('tv');
        //$result=$repo->findAllByQB();
       // $result=$repo->findByCategory('mobile');
//$result=$repo->myFindAll();
dd($result);
    }
}
