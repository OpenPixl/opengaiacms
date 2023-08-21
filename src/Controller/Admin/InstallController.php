<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Config;
use App\Form\Admin\InstallFormType;
use App\Repository\Admin\ConfigRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class InstallController extends AbstractController
{
    #[Route('/install', name: 'og_admin_install')]
    public function index(Request $request, ConfigRepository $configRepository, EntityManagerInterface $em): Response
    {
        $application = new Config();
        $form = $this->createForm(InstallFormType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($application);
            $em->flush();
            return $this->redirectToRoute('og_admin_interface_easy', [], Response::HTTP_SEE_OTHER);
        }
        // Insertion des élements de la table de Config
        return $this->render('admin/install/index.html.twig');
    }
}
