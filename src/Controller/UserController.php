<?php

namespace App\Controller;
// on stocke le controlleur dans l'espace de nom controller
// si on a besoin de cette class il faudrea rappeler son chemin
use App\Entity\User;
// Dans mon code je vais utiliser l'entité user notamment dans le cas de 
// la creation d'un user
use App\Form\UserType;
// par rapport au formlaire dans le cas ou je cree ou j'édite un user.
use App\Repository\UserRepository;
// le repository est cree au moment de l'entité
// il sert à recupérer les donnéees findall findby ...
//dans notre cas il sert à lire les donnéees mais pas pour lire une seule donnéé.
// On s'en sert pour la supression, modification
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// Pour toutes les les classes du controlleur
use Symfony\Component\HttpFoundation\Request;
// Les requetes envoyees par le navigateur (GET, POST...), dans tout les cas sauf la page avec toutes
// les donnees qui ne necessite pas de lire des donnees en GET
// Edit : POST les donnes du formulaire
// Nouveau user : POST les donnees du formulaire
// Supression : GET des données de l'URL
use Symfony\Component\HttpFoundation\Response;
// L'object qui retourne la twig.
// Afficher tous les user/ un seul user : Renvoie iune twig
// Nouvel utilisateur/ Edit : Renvoie une Twig
// Suppression d'un user : Redirection
use Symfony\Component\Routing\Annotation\Route;
// Dans chaque fonction j'ai besoin d'une URL.
// Du coup la classse route est appellé à chaque fonction

 
#[Route('admin/user')]
class UserController extends AbstractController
{

    
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
