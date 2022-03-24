<?php

namespace App\Controller\Admin;

use App\Entity\Fight;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FightCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fight::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
