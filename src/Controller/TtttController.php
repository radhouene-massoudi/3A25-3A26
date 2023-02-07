<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TtttController extends AbstractController
{
    #[Route('/tttt', name: 'app_tttt')]
    public function index(): Response
    {
        return $this->render('tttt/index.html.twig', [
            'controller_name' => 'TtttController',
        ]);
    }
}
