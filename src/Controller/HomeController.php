<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('Homepage/index.html.twig');
    }

    /**
     * @Route("/tc", name="tc")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tc()
    {
        return $this->render('Homepage/tc.html.twig');
    }
}
