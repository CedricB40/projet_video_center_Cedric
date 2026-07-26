<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Video; //on importe l'entité Video
use App\Entity\User; //on importe l'entité User (pour typer $this->getUser() dans les vérifications isVerified)

use Symfony\Component\HttpFoundation\Request; //pour la requete http envoyées par le navigateur (contient les données formulaire quand soumis)
use Doctrine\ORM\EntityManagerInterface; //le service doctrine qui save les data en base

use App\Form\VideoType; //on import le form de VideoType

use App\Repository\VideoRepository;

use Symfony\Component\Security\Http\Attribute\IsGranted; //sécurité pour la création

use Knp\Component\Pager\PaginatorInterface; //service KnpPaginator pour découper les résultats en pages

class VideoController extends AbstractController //on supprime final qui a été généré automatiquement (pour pouvoir hériter de ce controller)
{
    #[Route('/', name: 'app_home')] //route imposée dans les consignes
    public function index(VideoRepository $videoRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $search = $request->query->get('search'); //récupère le terme recherché depuis l'URL (?search=...), null si absent

        if ($search) {
            /**
             * @var User|null $user
             */
            $user = $this->getUser(); //null si non connecté
            $includePremium = $user !== null && $user->isVerified(); //vidéos premium visibles uniquement si connecté ET vérifié

            $queryBuilder = $videoRepository->findBySearchQueryBuilder($search, $includePremium); //requête filtrée titre/description, avec ou sans premium
            $limit = 6; //6 résultats par page pour la recherche, imposé par le cahier des charges
        } else {
            $queryBuilder = $videoRepository->findAllQueryBuilder(); //requête sur toutes les vidéos
            $limit = 9; //9 vidéos par page pour l'accueil sans recherche
        }

        $videos = $paginator->paginate(
            $queryBuilder, //requête non exécutée, le paginateur s'en charge avec LIMIT/OFFSET
            $request->query->getInt('page', 1), //numéro de page depuis l'URL (?page=2), 1 par défaut
            $limit
        );

        return $this->render('video/index.html.twig', [
            'videos' => $videos,
            'search' => $search, //renvoyé au template pour préremplir le champ de recherche
        ]);
    }

    #[Route('/video/create', name: 'app_video_create')] //route imposée dans les consignes
    #[IsGranted('IS_AUTHENTICATED_FULLY')] //couche 1 : bloque les utilisateurs non connectés (redirection auto vers /login)
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // couche 2 : bloque les utilisateurs connectés mais non vérifiés (email non confirmé)
        /**
         * @var User $user
         */
        $user = $this->getUser(); //on type explicitement $user en User (au lieu de UserInterface) pour l'analyseur statique

        if (!$user->isVerified()) {
            $this->addFlash('danger', 'Vous devez vérifier votre adresse email avant de pouvoir créer une vidéo.');

            return $this->redirectToRoute('app_home');
        }

        $video = new Video(); //on crée un objet Video vide
        $form = $this->createForm(VideoType::class, $video); //on crée le formulaire lié à cet objet

        $form->handleRequest($request); //on récupère les données envoyées si le formulaire est soumis

        if ($form->isSubmitted() && $form->isValid()) {
            $video->setAuteur($this->getUser()); //on assigne l'utilisateur connecté comme auteur de la vidéo
            $entityManager->persist($video);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('video/create.html.twig', [ //si pas encore soumis ou invalide, on affiche le formulaire
            'form' => $form->createView(),
        ]);
    }

    #[Route('/video/{id}', name: 'app_video_show')] //route imposée dans les consignes
    public function show(Video $video): Response
    {
        return $this->render('video/show.html.twig', [ //$video déjà récupérée via le param converter, on l'envoie au template
            'video' => $video,
        ]);
    }

    #[Route('/video/{id}/edit', name: 'app_video_edit')] //route imposée dans les consignes
    #[IsGranted('IS_AUTHENTICATED_FULLY')] //couche 1 : bloque les utilisateurs non connectés (redirection auto vers /login)
    public function edit(Video $video, Request $request, EntityManagerInterface $entityManager): Response
    {
        // couche 2 : bloque les utilisateurs connectés mais non vérifiés (email non confirmé)
        /**
         * @var User $user
         */
        $user = $this->getUser(); //on type explicitement $user en User (au lieu de UserInterface) pour l'analyseur statique

        if (!$user->isVerified()) {
            $this->addFlash('danger', 'Vous devez vérifier votre adresse email avant de pouvoir modifier une vidéo.');

            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(VideoType::class, $video); //formulaire pré-rempli avec les données existantes de $video

        $form->handleRequest($request); //on récupère les données si le formulaire est soumis

        if ($form->isSubmitted() && $form->isValid()) { //si soumis et valide
            $entityManager->flush(); //pas de persist ici, $video est déjà connue de Doctrine

            return $this->redirectToRoute('app_video_show', ['id' => $video->getId()]); //redirection vers la fiche de la vidéo modifiée
        }

        return $this->render('video/edit.html.twig', [ //si pas encore soumis ou invalide, on affiche le formulaire pré-rempli
            'form' => $form->createView(),
        ]);
    }

    #[Route('/video/{id}/delete', name: 'app_video_delete')] //route imposée dans les consignes
    public function delete(Video $video, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $video->getId(), $request->request->get('_token'))) { //vérifie si le tolken csrf est valide (authorisation obligatoire)
            $entityManager->remove($video); // video supprimée
            $entityManager->flush(); //exécute la suppression de la base de donnée
        }

        return $this->redirectToRoute('app_home'); //redirection vers l'accueil
    }
}