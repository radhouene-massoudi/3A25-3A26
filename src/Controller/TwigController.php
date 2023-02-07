<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends AbstractController
{
    #[Route('/twig', name: 'app_twig')]
    public function index()
    {
        return $this->render('twig/index.html.twig', [
            'controller_name' => 'TwigController',
        ]);
    }
    #[Route('/showV/{name}', name: 'showV')]
    public function showV($name)
    {
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Formation Symfony
            4','Description'=>'formation pratique',
            'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020',
            'nb_participants'=>19) ,
            array('ref'=>'form177','Titre'=>'Formation SOA' ,
            'Description'=>'formation
            theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
            'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
            'Description'=>'formation
            theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
            'nb_participants'=>12));
        return $this->render('twig/traitement.html.twig', [
           'v'=>$name
        ]);
    }

    #[Route('/ateler', name: 'ateler')]
    public function ateler()
    {
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Symfony
            4','Description'=>'formation pratique',
            'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020',
            'nb_participants'=>19) ,

            array('ref'=>'form177','Titre'=>'Formation SOA' ,
            'Description'=>'formation
            theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
            'nb_participants'=>0),

            array('ref'=>'form178','Titre'=>'Angular' ,
            'Description'=>'formation
            theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
            'nb_participants'=>12));
        return $this->render('twig/atelier3.html.twig', [
           'f'=>$formations
        ]);
    }
    #[Route('/detail/{id}', name: 'detail22')]
    public function detail($id)
    {
        return $this->render('twig/detail.html.twig', [
            'idofFormation' => $id,
        ]);
    } 
}
