<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\CommentaireType;
use App\Form\ProduitType;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailproduitController extends AbstractController
{
    #[Route('/detailproduit/{id}', name: 'app_detailproduit')]
    public function index(Produit $produit, CommentaireRepository $commentaireRepository): Response
    {
        $form = $this->createForm(CommentaireType::class);

         // on veut afficher les commentaires 
        // correspondant aux produit de l'id de l'url.
        // on utilise le repository qui va chercher avec un critere findby
        // selon le produits 

        //($toutlescommentaires=$commentaireRepository->findAll());
        $commentaireparproduit=$commentaireRepository->findBy([
            'produits' =>$produit
        ]
        );
    
         // $produit correspond à l'entité produit de l'identifiant envoyé
        // en parametre
        return $this->renderForm('detailproduit/index.html.twig', [
            'le_produit' => $produit,
            'mescommentaires' => '$commentaireparproduit',
            'form' => $form
        ]);
    }
}
