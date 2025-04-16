<?php

namespace App\Controller\Admin\Blog;

use App\Entity\Blog\Post;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Posts')
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(3)
            ->showEntityActionsInlined();
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title');
        yield TextEditorField::new('text');
        yield AssociationField::new('category');
        yield BooleanField::new('is_published', 'Published')->setPermission('ROLE_ADMIN');
        yield AssociationField::new('createdByUser')
        ->setDisabled()
        ->setLabel('Author')
        ->hideWhenCreating();

        if (!in_array($pageName, [Crud::PAGE_NEW, Crud::PAGE_EDIT])) {
            yield DateField::new('created');
        }
    }

    /**
     * Documentation https://symfony.com/bundles/EasyAdminBundle/current/crud.html#creating-persisting-and-deleting-entities
     */
    public function createEntity(string $entityFqcn)
    {
        $post = new Post();
        $post->setCreatedByUser($this->getUser());
        $post->setModifiedByUser($this->getUser());

        return $post;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Post) return;

        $entityInstance->setModifiedByUser($this->getUser());


        parent::updateEntity($entityManager, $entityInstance);
    }
}
