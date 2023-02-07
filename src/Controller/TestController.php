<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/tt', name: 'tttttt')]
    public function index(): Response
    {
        return new Response('bonjour 3A25 3A26');
    }
    #[Route('/test', name: 'test')]
    public function test()
    {
        return new Response('<h1> bonjour 3A25 3A26 </h1>');
    }
    #[Route('/json', name: 'json')]
    public function jsontest()
    {
        return new JsonResponse(' bonjour 3A25 3A26 sjdsdjbvsd ');
    }
    #[Route('/bon/{k}', name: 'bon')]
    public function sayBonjour($k)
    {
        return new Response(' bonjour'.$k);
    }
    #[Route('/vershtml', name: 'vershtml')]
    public function show()
    {
        return $this->render('3A/show.html.twig');
    }

    #[Route('/test2', name: 'test2')]
    public function test2()
    {
        
        //return $this->render('3A/show.html.twig');
    }
}
