<?php

namespace App\Controller\Blog;

use App\Entity\Blog\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    #[Route('/blog/post/{slug}', name: 'app_blog_post')]
    public function index(Post $post): Response
    {
        return $this->render('blog/post/index.html.twig', [
            'post' => $post,
        ]);
    }
}
