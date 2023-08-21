<?php

namespace App\Controller\Admin\Easy;

use App\Entity\Admin\Member;
use App\Entity\Admin\UnderConstruction;
use App\Entity\Webapp\Page;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator,)
    {
    }

    #[Route('/easyadmin', name: 'og_admin_interface_easy')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        //return parent::index();
        return $this->redirect($adminUrlGenerator->setController(MemberCrudController::class)->generateUrl());
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Opengaiacms');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Web application');
        yield MenuItem::linkToCrud('Pages', 'fas fa-list', Page::class);
        yield MenuItem::section('Administration');
        yield MenuItem::linkToCrud('Membre', 'fas fa-list', Member::class);
        yield MenuItem::linkToCrud('Show Main Category', 'fa fa-tags', UnderConstruction::class)
            ->setAction('detail')
            ->setEntityId(1);
        yield MenuItem::linkToCrud('Hors Ligne', 'fas fa-list', UnderConstruction::class);

    }
}
