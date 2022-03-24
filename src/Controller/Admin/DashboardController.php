<?php

namespace App\Controller\Admin;

use App\Entity\Action;
use App\Entity\Character;
use App\Entity\Fight;
use App\Entity\Formation;
use App\Entity\Strategy;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Speleomatt');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Menu', 'fa fa-home');
        yield MenuItem::linktoRoute('Retour au site', 'fas fa-home', 'app_login');
        yield MenuItem::linkToCrud('Gestion des utilisateurs', 'fas fa-map-marker-alt', User::class);
        yield MenuItem::linkToCrud('Combat', 'fas fa-map-marker-alt', Fight::class);
        yield MenuItem::linkToCrud('Formation', 'fas fa-map-marker-alt', Formation::class);
        yield MenuItem::linkToCrud('Personnage', 'fas fa-map-marker-alt', Character::class);
        yield MenuItem::linkToCrud('Stratégie', 'fas fa-map-marker-alt', Strategy::class);
        yield MenuItem::linkToCrud('Action', 'fas fa-map-marker-alt', Action::class);
    }
}
