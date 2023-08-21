<?php

namespace App\Controller\Webapp;

use App\Entity\Admin\Config;
use App\Repository\Admin\ConfigRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    #[Route('/', name: 'og_webapp_public_index')]
    public function index(ConfigRepository $configRepository, Request $request): Response
    {
        $config = $configRepository->findFirstReccurence();
        if(!$config)
        {
            return $this->redirectToRoute('og_admin_install');
        }
        return $this->render('webapp/public/index.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
}
