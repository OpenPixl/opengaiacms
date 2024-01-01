<?php

namespace App\Controller\Webapp;

use App\Entity\Webapp\Block;
use App\Entity\Webapp\Page;
use App\Form\Webapp\BlockType;
use App\Repository\Webapp\BlockRepository;
use App\Repository\Webapp\BlockTypeRepository;
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
        return $this->render('webapp/block/include/_listbypage.html.twig', [
            'blocks' => $blockRepository->findBy(['page' => $page]),
            'idpage' => $idpage
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

    #[Route('/addblock/{idpage}/{idblocktype}', name: 'og_webapp_page_addblock', methods: ['GET', 'POST'])]
    public function addBlock($idpage, $idblocktype, BlockRepository $blockRepository, BlockTypeRepository $blockTypeRepository, PageRepository $pageRepository, EntityManagerInterface $entityManager)
    {
        $blocktype = $blockTypeRepository->find($idblocktype);
        $page = $pageRepository->find($idpage);

        $nameBlock = substr($blocktype->getName(), 0,3);
        $namePage = substr($page->getName(), 0,3);

        //dd($blocktype, $page);

        $block = new Block();
        $block->setName($namePage.$nameBlock);
        $block->setPage($page);
        $block->setBlockType($blocktype);
        $entityManager->persist($block);
        $entityManager->flush();

        $blocks = $blockRepository->findBy(['page'=>$page]);
        return $this->json([
            "code"=>200,
            "message"=>"Le block est ajouté à votre page.",
            'liste' => $this->renderView('webapp/block/include/_listbypage.html.twig', [
                'blocks' => $blocks
            ])
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
    public function edit(Request $request, Block $block, EntityManagerInterface $entityManager, BlockRepository $blockRepository): Response
    {
        $form = $this->createForm(BlockType::class, $block, [
            'action' => $this->generateUrl('og_webapp_block_edit', ['id' => $block->getId()]),
            'method' => 'POST',
            'attr' => ['class'=>'formBlock']
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $blocks = $blockRepository->findAll();

            //return $this->redirectToRoute('app_webapp_page_index', [], Response::HTTP_SEE_OTHER);
            return $this->json([
                'code' => 200,
                'message' => 'La page a été crée avec success.',
                'liste' => $this->renderView('webapp/block/include/_listbypage.html.twig', [
                    'blocks' => $block
                ])
            ], 200);
        }

        $view = $this->render('webapp/block/_form.html.twig', [
            'block' => $block,
            'form' => $form
        ]);

        return $this->json([
            'code' => 200,
            'message' => 'formulaire présenté',
            'formView' => $view->getContent()
        ]);
    }

    #[Route('/{id}', name: 'og_webapp_block_delete', methods: ['POST'])]
    public function delete(Request $request, Block $block, EntityManagerInterface $entityManager): Response
    {
        $page = $block->getPage();
        
        if ($this->isCsrfTokenValid('delete'.$block->getId(), $request->request->get('_token'))) {
            $entityManager->remove($block);
            $entityManager->flush();
        }

        return $this->redirectToRoute('og_webapp_page_show', [
            'id' => $page->getId()
        ], Response::HTTP_SEE_OTHER);
    }
}
