<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController.
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     *
     * @param BlogPostRepository $blogPostRepository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(BlogPostRepository $blogPostRepository)
    {
        $all = $blogPostRepository->findBy([], ['id' => 'DESC']);

        return $this->render('Blog/index.html.twig', [
            'posts' => $all,
        ]);
    }

    /**
     * @Route("/blog/{slug}", name="blog_post")
     *
     * @param BlogPost $blogPost
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function blogPost(BlogPost $blogPost)
    {
        return $this->render('Blog/post.html.twig', [
            'post' => $blogPost,
        ]);
    }
}
