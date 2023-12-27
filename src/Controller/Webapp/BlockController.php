<?php

namespace App\Controller\Webapp;

use App\Entity\Webapp\Block;
use App\Form\Webapp\BlockType;
use App\Repository\Webapp\BlockRepository;
use App\Repository\Webapp\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/webapp/block')]
class BlockController extends AbstractController
{
    #[Route('/', name: 'og_webapp_block_index', methods: ['GET'])]
    public function index(BlockRepository $blockRepository): Response
    {
        return $this->render('webapp/block/index.html.twig', [
            'blocks' => $blockRepository->findAll(),
        ]);
    }

    #[Route('/listbypage/{idpage}', name: 'og_webapp_block_listbypage', methods: ['GET'])]
    public function listByPage(BlockRepository $blockRepository, $idpage, PageRepository $pageRepository): Response
    {
        $page = $pageRepository->find($idpage);
        return $this->render('webapp/block/listbypage.html.twig', [
            'blocks' => $blockRepository->findBy(['page' => $page]),
        ]);
    }

    #[Route('/new', name: 'og_webapp_block_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $block = new Block();
        $form = $this->createForm(BlockType::class, $block);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($block);
            $entityManager->flush();

            return $this->redirectToRoute('og_webapp_block_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webapp/block/new.html.twig', [
            'block' => $block,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'og_webapp_block_show', methods: ['GET'])]
    public function show(Block $block): Response
    {
        return $this->render('webapp/block/show.html.twig', [
            'block' => $block,
        ]);
    }

    #[Route('/{id}/edit', name: 'og_webapp_block_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Block $block, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BlockType::class, $block);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('og_webapp_block_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webapp/block/edit.html.twig', [
            'block' => $block,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'og_webapp_block_delete', methods: ['POST'])]
    public function delete(Request $request, Block $block, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$block->getId(), $request->request->get('_token'))) {
            $entityManager->remove($block);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_webapp_block_index', [], Response::HTTP_SEE_OTHER);
    }
}
