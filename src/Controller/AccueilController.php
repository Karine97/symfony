<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(Request $request): Response
    {
        $profil = [];
        $profil['nom'] = "Cassius";
        $profil['prenom'] = "Clay";
        $profil['age'] = "45";
        return $this->render('accueil/index.html.twig', [
            'monprofil' => $profil,
        ]);
    }
}
