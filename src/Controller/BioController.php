<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 8/3/2018
 * Time: 2:43 AM
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BioController extends AbstractController
{
    /**
     * @Route("/bio", name="bio_index")
     */
    public function index()
    {
        return $this->render('Bio/index.html.twig');
    }
}