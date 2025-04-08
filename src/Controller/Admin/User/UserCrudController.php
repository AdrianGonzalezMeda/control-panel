<?php

/**
 * Documentation CRUD Controllers https://symfony.com/bundles/EasyAdminBundle/current/crud.html 
 */

namespace App\Controller\Admin\User;

use App\Entity\Admin\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('Users')
            ->setPageTitle(Crud::PAGE_INDEX, '%entity_label_plural% listing')
            ->setHelp(Crud::PAGE_INDEX, 'Control panel users')
            ->setPageTitle(Crud::PAGE_EDIT, fn(User $user) => sprintf('Editing <b>%s</b>', $user->getUsername()))
            ->setPageTitle(Crud::PAGE_DETAIL, fn(User $user) => sprintf('User: <b>%s</b>', $user->getUsername()))
            ->setSearchFields(['username', 'email'])
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(3);
    }

    /**
     * Documentation Fields https://symfony.com/bundles/EasyAdminBundle/current/fields.html
     */
    public function configureFields(string $pageName): iterable
    {
        yield EmailField::new('email');
        yield TextField::new('username');
        yield ChoiceField::new('roles')
            ->setChoices([
                'Usuario' => 'ROLE_USER',
                'Admin' => 'ROLE_ADMIN',
            ])
            ->allowMultipleChoices();

        switch ($pageName) {
            case Crud::PAGE_DETAIL:
                yield DateTimeField::new('created');
                yield DateTimeField::new('modified');

                break;
            case Crud::PAGE_EDIT:
                // TODO
                break;
            case Crud::PAGE_INDEX:
                yield DateTimeField::new('created');

                break;
            case Crud::PAGE_NEW:
                yield TextField::new('password');

                break;
        }
    }
}
