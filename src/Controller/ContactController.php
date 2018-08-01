<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 8/1/2018
 * Time: 4:02 AM
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @return mixed
     *
     * @Route("/contact")
     */
    public function index()
    {

        return $this->render('Contact/index.html.twig');
    }
}