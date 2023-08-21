<?php

namespace App\Controller\Admin\Easy;

use App\Entity\Admin\UnderConstruction;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UnderConstructionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UnderConstruction::class;
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
