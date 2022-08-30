<?php

namespace App\Controller\Admin;

use App\Entity\InformationsOfRooms;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InformationsOfRoomsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InformationsOfRooms::class;
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
