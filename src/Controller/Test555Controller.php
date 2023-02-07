<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Test555Controller extends AbstractController
{
    #[Route('/test555', name: 'app_test555')]
    public function index(): Response
    {
        return $this->render('test555/index.html.twig', [
            'controller_name' => 'Test555Controller',
        ]);
    }
}
