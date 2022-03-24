<?php

namespace App\Controller\Admin;

use App\Entity\Strategy;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StrategyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Strategy::class;
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
