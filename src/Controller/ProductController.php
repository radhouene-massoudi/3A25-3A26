<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
