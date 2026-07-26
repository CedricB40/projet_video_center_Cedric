<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\User; //on importe l'entité User (pour typer $this->getUser())
use App\Form\AccountType; //on importe le formulaire d'édition du profil

use Symfony\Component\HttpFoundation\Request; //pour la requete http envoyées par le navigateur (contient les données formulaire quand soumis)
use Doctrine\ORM\EntityManagerInterface; //le service doctrine qui save les data en base

use Symfony\Component\Security\Http\Attribute\IsGranted; //sécurité pour l'accès au profil

class AccountController extends AbstractController //on supprime final (convention CFITECH)
{
    #[Route('/account', name: 'app_account')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')] //accessible aux utilisateurs connectés, même non vérifiés
    public function index(): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser(); //on récupère l'utilisateur connecté, typé explicitement en User
        $videos = $user->getVideos(); //récupère la collection des vidéos de cet utilisateur via la relation OneToMany déjà existante (pas besoin de nouvelle requête)

        return $this->render('account/index.html.twig', [
            'user' => $user, //on envoie l'utilisateur au template pour affichage
            'videos' => $videos,
        ]);
    }

    #[Route('/account/edit', name: 'app_account_edit')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')] //accessible aux utilisateurs connectés, même non vérifiés
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser(); //on récupère l'utilisateur connecté, typé explicitement en User

        $form = $this->createForm(AccountType::class, $user); //formulaire pré-rempli avec les données existantes de $user

        $form->handleRequest($request); //on récupère les données si le formulaire est soumis

        if ($form->isSubmitted() && $form->isValid()) { //si soumis et valide
            $entityManager->flush(); //pas de persist ici, $user est déjà connu de Doctrine

            return $this->redirectToRoute('app_account'); //redirection vers la page de profil après modification
        }

        return $this->render('account/edit.html.twig', [ //si pas encore soumis ou invalide, on affiche le formulaire pré-rempli
            'form' => $form->createView(),
        ]);
    }
}