<?php

namespace App\Controller\Webapp;

use App\Entity\Admin\Config;
use App\Entity\Admin\UnderConstruction;
use App\Repository\Admin\ApplicationRepository;
use App\Repository\Admin\ConfigRepository;
use App\Repository\Admin\UnderConstructionRepository;
use App\Repository\Webapp\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    #[Route('/', name: 'og_webapp_public_index')]
    public function index(ConfigRepository $configRepository, Request $request): Response
    {
        $config = $configRepository->findFirstReccurence();
        if(!$config){
            return $this->redirectToRoute('og_admin_install_step1');
        }else{
            $step = $config->getStep();
            if($step === 1 ){
                return $this->redirectToRoute('og_admin_install_step2');
            }
        }
        return $this->redirectToRoute('og_webapp_public_homepage');
    }

    /**
     * Affiche les différents menus sur la page d'accueil
     */
    #[Route("/webapp/public/menus/{route}", name: 'op_webapp_public_listmenus')]
    public function BlocMenu(PageRepository $pageRepository, ApplicationRepository $applicationRepository, Request $request, $route): Response
    {
        // on récupère l'utilisateur courant
        $user = $this->getUser();

        // préparation des éléments d'interactivité du menu
        $application = $applicationRepository->findFirstReccurence();
        $menus = $pageRepository->listMenu();

        return $this->render('include/app/navbar.html.twig', [
            'application' => $application,
            'menus' => $menus,
            'route' => $route,
        ]);
    }

    #[Route("/home", name: 'og_webapp_public_homepage')]
    public function homepage(ConfigRepository $configRepository)
    {
        $config = $configRepository->findFirstReccurence();
        $offline = $config->IsIsOffLine();
        //dd($config);
        if($offline == 1)
        {
            return $this->redirectToRoute('og_webapp_public_offline');
        }
        return $this->render('webapp/public/homepage.html.twig');
    }

    #[Route("/offline", name: 'og_webapp_public_offline')]
    public function offline(
        UnderConstructionRepository $underConstructionRepository,
        ApplicationRepository $applicationRepository
    )
    {
        $application = $applicationRepository->findFirstReccurence();
        $offline = $underConstructionRepository->findFirstReccurence();

        return $this->render('webapp/public/offline.html.twig', [
            'application' => $application,
            'offline' => $offline
        ]);
    }
}
