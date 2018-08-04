<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorFormType;
use App\Repository\AuthorRepository;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController.
 */
class AdminController extends Controller
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var AuthorRepository */
    private $authorRepository;

    /** @var BlogPostRepository */
    private $blogPostRepository;

    /**
     * AdminController constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param AuthorRepository       $authorRepository
     * @param BlogPostRepository     $blogPostRepository
     */
    public function __construct(EntityManagerInterface $entityManager, AuthorRepository $authorRepository, BlogPostRepository $blogPostRepository)
    {
        $this->entityManager = $entityManager;
        $this->blogPostRepository = $authorRepository;
        $this->authorRepository = $blogPostRepository;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('Admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/author/create", name="author_create")
     *
     * @param Request $request
     *
     * @throws \Doctrine\ORM\ORMException
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAuthor(Request $request)
    {
        if ($this->authorRepository->findOneBy(['username' => 'none'])) {
            // Redirect to dashboard.
            $this->addFlash('error', 'Unable to create author, author already exists!');

            return $this->redirectToRoute('home_index');
        }

        $author = new Author();
        $author->setUsername($this->getUser()->getUserName());

        $form = $this->createForm(AuthorFormType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($author);
            $this->entityManager->flush();

            $request->getSession()->set('user_is_author', true);
            $this->addFlash('success', 'Congratulations! You are now an author.');

            return $this->redirectToRoute('home_index');
        }

        return $this->render('admin/create_author.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
