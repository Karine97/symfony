<?php

namespace App\Controller;

use App\Form\FormjeuType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormjeuController extends AbstractController
{
    #[Route('/formjeu', name: 'app_formjeu')]
    public function index(Request $request): Response
    {

        // récupère le formulaire dans une variable correspondant à FormjeuType
        $form = $this->createForm(FormjeuType::class);

        // on prend l'objet form qui va lire la request
        $form->handleRequest($request);

        // test si l'envoi POST et est valide et bien envoyé
        if ($form->isSubmitted() && $form->isValid()) { // instruction
        
        // Créer une variable $gagner qui est un tableau clé valeur
        //contenant les données envoyées en POST
         $gagner= $form->getData();

             // créer un variable aléatoire va être généré 
     $gagner['numberAlea']=rand(1, 100);

     // on va créer une clé reponse dans la variable gagner
     // contenant gagné ou perdu !
     
        if ($gagner['numberAlea'] == $gagner['nombre']){
            $gagner['reponse']="Vous avez gagné";
        }else{ 
            $gagner['reponse']="Vous avez perdu";
        }

    // on va tester elle est égal à ce qui est inséré

        return $this->render('form_jeu/traitement.html.twig', [
        'mesdonnees'=>$gagner ,
    ]);
    
    } 
        return $this->renderForm('formjeu/index.html.twig', [
            'monresultat' => $form
        ]);
    }
}
