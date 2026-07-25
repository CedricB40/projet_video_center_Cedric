<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Video; //on importe l'entité Video

class VideoController extends AbstractController //on supprime final qui a été généré automatiquement (pour pouvoir hériter de ce controller)
{
    #[Route('/', name: 'app_home')] //route imposée dans les consignes
    public function index(): Response
    {
        return $this->render('video/index.html.twig', [
            'controller_name' => 'VideoController',
        ]);
    }

    #[Route('/video/create', name: 'app_video_create')] //route imposée dans les consignes
    public function create(): Response
    {
        return new Response("Page de creation"); //retour temporaire, logique CRUD à venir
    }

    #[Route('/video/{id}', name: 'app_video_show')] //route imposée dans les consignes
    public function show(Video $video): Response
    {
        return new Response('Vidéo : ' . $video->getTitle()); //retour temporaire, logique CRUD à venir
    }

    #[Route('/video/{id}/edit', name: 'app_video_edit')] //route imposée dans les consignes
    public function edit(Video $video): Response
    {
        return new Response('Édition de : ' . $video->getTitle()); //retour temporaire, logique CRUD à venir
    }

    #[Route('/video/{id}/delete', name: 'app_video_delete')] //route imposée dans les consignes
    public function delete(Video $video): Response
    {
        return new Response('Suppression de : ' . $video->getTitle()); //retour temporaire, logique CRUD à venir
    }
}