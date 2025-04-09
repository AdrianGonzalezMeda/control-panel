<?php

namespace App\Controller\Blog;

use App\Entity\Blog\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/blog/category/{slug}', name: 'app_blog_category')]
    public function index(Category $category): Response
    {
        return $this->render('blog/category/index.html.twig', [
            'category' => $category,
        ]);
    }
}
