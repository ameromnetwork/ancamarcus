<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ShopController.
 */
class ShopController extends AbstractController
{
    /**
     * @Route("/shop", name="shop_index")
     */
    public function index()
    {
        return $this->render('Shop/index.html.twig');
    }
}
