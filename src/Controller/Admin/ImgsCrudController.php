<?php

namespace App\Controller\Admin;

use App\Entity\Imgs;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ImgsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Imgs::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('url')
              ->setBasePath('uploads/')
              ->setUploadDir('public/uploads')
              ->setUploadedFileNamePattern('[randomhash].[extension]')
              ->setRequired(false),
            BooleanField::new('intro')
        ];
    }
}

