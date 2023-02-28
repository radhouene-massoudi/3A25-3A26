<?php

namespace App\Controller;

use App\Entity\Compture;
use App\Form\ComptureType;
use App\Repository\DepartementRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartementController extends AbstractController
{
    #[Route('/departement', name: 'app_departement')]
    public function index(DepartementRepository $repo): Response
    {
        return $this->render('departement/index.html.twig', [
            'departments' => $repo->findAll(),
        ]);
    }
    #[Route('/addCompture/{iddep}', name: 'addC')]
    public function addCompture(Request $req, ManagerRegistry $mr,$iddep,DepartementRepository $repodep): Response
    {

        $c = new Compture();
        $form = $this->createForm(ComptureType::class, $c);
        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $em = $mr->getManager();
            $c->setDepartement($repodep->find($iddep));
            $em->persist($c);
            $em->flush();
        }

        return $this->renderForm('departement/addc.html.twig', [
            'f'=>$form
        ]);
    }
}
