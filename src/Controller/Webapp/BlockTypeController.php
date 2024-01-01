<?php

namespace App\Controller\Webapp;

use App\Entity\Webapp\BlockType;
use App\Form\Webapp\BlockTypeType;
use App\Repository\Webapp\BlockTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/webapp/block/type')]
class BlockTypeController extends AbstractController
{
    #[Route('/', name: 'app_webapp_block_type_index', methods: ['GET'])]
    public function index(BlockTypeRepository $blockTypeRepository): Response
    {
        return $this->render('webapp/block_type/index.html.twig', [
            'block_types' => $blockTypeRepository->findAll(),
        ]);
    }

    #[Route('/listadmin/{content}/{idpage}', name: 'app_webapp_block_listadmin', methods: ['GET'])]
    public function listAdmin($content, BlockTypeRepository $blockTypeRepository, $idpage): Response
    {
        $blocktypes = $blockTypeRepository->findBy(['content' => $content]);
        //dd($blocktypes);
        return $this->render('webapp/block/list.html.twig', [
            'blocktypes' => $blocktypes,
            'idpage' => $idpage
        ]);
    }

    #[Route('/new', name: 'app_webapp_block_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $blockType = new BlockType();
        $form = $this->createForm(BlockTypeType::class, $blockType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($blockType);
            $entityManager->flush();

            return $this->redirectToRoute('app_webapp_block_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webapp/block_type/new.html.twig', [
            'block_type' => $blockType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_webapp_block_type_show', methods: ['GET'])]
    public function show(BlockType $blockType): Response
    {
        return $this->render('webapp/block_type/show.html.twig', [
            'block_type' => $blockType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_webapp_block_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BlockType $blockType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BlockTypeType::class, $blockType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_webapp_block_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webapp/block_type/edit.html.twig', [
            'block_type' => $blockType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_webapp_block_type_delete', methods: ['POST'])]
    public function delete(Request $request, BlockType $blockType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blockType->getId(), $request->request->get('_token'))) {
            $entityManager->remove($blockType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_webapp_block_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
