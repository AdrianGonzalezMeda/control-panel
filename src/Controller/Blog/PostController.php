<?php

namespace App\Controller\Blog;

use App\Entity\Blog\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/admin/blog/post/{id}', name: 'admin_review_post')]
    public function reviewComment(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $accepted = !$request->query->get('reject');
        $post->setIsPublished($accepted);
        $entityManager->persist($post);
        $entityManager->flush();
        
        return $this->redirectToRoute('admin_post_detail', ['entityId' => $post->getId()]);
    }
}
