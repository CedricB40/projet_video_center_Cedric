<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Video; //on importe l'entité Video

use Symfony\Component\HttpFoundation\Request; //pour la requete http envoyées par le navigateur (contient les données formulaire quand soumis)
use Doctrine\ORM\EntityManagerInterface; //le service doctrine qui save les data en base

use App\Form\VideoType; //on import le form de VideoType

use App\Repository\VideoRepository;

class VideoController extends AbstractController //on supprime final qui a été généré automatiquement (pour pouvoir hériter de ce controller)
{
    #[Route('/', name: 'app_home')] //route imposée dans les consignes
    public function index(VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findAll(); //récupère toutes les vidéos en base

        return $this->render('video/index.html.twig', [
            'videos' => $videos,
        ]);
    }

    #[Route('/video/create', name: 'app_video_create')] //route imposée dans les consignes
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
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
    public function edit(Video $video, Request $request, EntityManagerInterface $entityManager): Response
    {
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
