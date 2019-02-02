<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 8/3/2018
 * Time: 3:13 AM.
 */

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
