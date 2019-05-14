<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use App\Repository\CategoryRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(BlogPostRepository $posts, TagRepository $tags, CategoryRepository $categories, Request $request)
    {
        $tag = null;
        $category = null;
        
        if ($request->query->has('tag')) {
            $tag = $tags->findOneBy(['slug' => $request->query->get('tag')]);
//            dd($tag);
        }
    
        if ($request->query->has('category')) {
            $category = $categories->findOneBy(['slug' => $request->query->get('category')]);
        }
        $latestPosts = $posts->findLatest($tag, $category);
        
//        /** @var BlogPost $post */
//        foreach ($latestPosts as $post) {
//            foreach ($post->getTags() as $tag) {
//                var_dump($tag->getId());
//                var_dump($tag->getSlug());
//            }
//        }
//        die;

//        $all = $blogPostRepository->findBy([], ['id' => 'DESC']);
//        dd($latestPosts);
        return $this->render('Blog/index.html.twig', [
            'posts' => $latestPosts,
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
