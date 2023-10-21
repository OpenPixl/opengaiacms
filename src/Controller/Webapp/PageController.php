<?php

namespace App\Controller\Webapp;

use App\Entity\Webapp\Page;
use App\Form\Webapp\PageType;
use App\Repository\Webapp\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/webapp/page')]
class PageController extends AbstractController
{
    #[Route('/', name: 'og_webapp_page_index', methods: ['GET'])]
    public function index(PageRepository $pageRepository): Response
    {
        return $this->render('webapp/page/index.html.twig', [
            'pages' => $pageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'og_webapp_page_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $page = new Page();
        $form = $this->createForm(PageType::class, $page, [
            'action' => $this->generateUrl('og_webapp_page_new'),
            'method' => 'POST',
            'attr' => ['class'=>'formAddPage']
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($page);
            $entityManager->flush();

            //return $this->redirectToRoute('app_webapp_page_index', [], Response::HTTP_SEE_OTHER);
            return $this->json([
                'code' => 200,
                'message' => 'La page a été crée avec success.',
            ], 200);
        }

        $view = $this->render('webapp/page/_form.html.twig', [
            'page' => $page,
            'form' => $form
        ]);

        return $this->json([
            'code' => 200,
            'message' => 'formulaire présenté',
            'formView' => $view->getContent()
        ]);
    }

    #[Route('/{id}', name: 'og_webapp_page_show', methods: ['GET'])]
    public function show(Page $page): Response
    {
        return $this->render('webapp/page/show.html.twig', [
            'page' => $page,
        ]);
    }

    #[Route('/{id}/edit', name: 'og_webapp_page_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Page $page, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_webapp_page_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webapp/page/edit.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'og_webapp_page_delete', methods: ['POST'])]
    public function delete(Request $request, Page $page, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$page->getId(), $request->request->get('_token'))) {
            $entityManager->remove($page);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_webapp_page_index', [], Response::HTTP_SEE_OTHER);
    }
}