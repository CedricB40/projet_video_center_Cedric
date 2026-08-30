<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Video;
use App\Entity\User;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\VideoType;

use App\Repository\VideoRepository;

use Symfony\Component\Security\Http\Attribute\IsGranted;

use Knp\Component\Pager\PaginatorInterface;

use Symfony\Contracts\Translation\TranslatorInterface;

class VideoController extends AbstractController
{
    #[Route(path: '/', name: 'app_home')]
    public function index(VideoRepository $videoRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $search = $request->query->get('search');

        if ($search) {
            /**
             * @var User|null $user
             */
            $user = $this->getUser();
            $includePremium = $user !== null && $user->isVerified();

            $queryBuilder = $videoRepository->findBySearchQueryBuilder($search, $includePremium);
            $limit = 6;
        } else {
            /**
             * @var User|null $user
             */
            $user = $this->getUser();
            $includePremium = $user !== null && $user->isVerified();

            $queryBuilder = $videoRepository->findAllQueryBuilder($includePremium);
            $limit = 9;
        }

        $videos = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            $limit
        );

        return $this->render('video/index.html.twig', [
            'videos' => $videos,
            'search' => $search,
        ]);
    }

    #[Route(path: '/video/create', name: 'app_video_create')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')] //couche 1 : bloque si non connecté
    public function create(Request $request, EntityManagerInterface $entityManager, TranslatorInterface $translator): Response
    {
        // couche 2 : bloque si non vérifié
        /**
         * @var User $user
         */
        $user = $this->getUser();

        if (!$user->isVerified()) {
            $this->addFlash('danger', $translator->trans('flash.videoCreateVerifyRequired'));

            return $this->redirectToRoute('app_home');
        }

        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $video->setAuteur($this->getUser()); //auteur = utilisateur connecté
            $entityManager->persist($video);
            $entityManager->flush();

            $this->addFlash('success', $translator->trans('flash.videoCreateSuccess'));

            return $this->redirectToRoute('app_home');
        }

        return $this->render('video/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/video/{id}', name: 'app_video_show')]
    public function show(Video $video): Response
    {
        /**
         * @var User|null $user
         */
        $user = $this->getUser(); //null si non connecté

        if ($video->isPremiumVideo() && ( //bloque l'accès aux vidéos premium
            $user === null ||
            !$user->isVerified()
        )) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('video/show.html.twig', [
            'video' => $video,
        ]);
    }

    #[Route(path: '/video/{id}/edit', name: 'app_video_edit')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')] //couche 1 : bloque si non connecté
    public function edit(Video $video, Request $request, EntityManagerInterface $entityManager, TranslatorInterface $translator): Response
    {
        // couche 3 : bloque si pas l'auteur
        if ($video->getAuteur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        // couche 2 : bloque si non vérifié
        /**
         * @var User $user
         */
        $user = $this->getUser();

        if (!$user->isVerified()) {
            $this->addFlash('danger', $translator->trans('flash.videoEditVerifyRequired'));

            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(VideoType::class, $video); //formulaire pré-rempli

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush(); //pas de persist, $video déjà connue de Doctrine

            $this->addFlash('success', $translator->trans('flash.videoEditSuccess'));

            return $this->redirectToRoute('app_video_show', ['id' => $video->getId()]);
        }

        return $this->render('video/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/video/{id}/delete', name: 'app_video_delete')]
    public function delete(Video $video, Request $request, EntityManagerInterface $entityManager): Response
    {
        // bloque si pas l'auteur
        if ($video->getAuteur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete' . $video->getId(), $request->request->get('_token'))) {
            $entityManager->remove($video);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_home');
    }
}