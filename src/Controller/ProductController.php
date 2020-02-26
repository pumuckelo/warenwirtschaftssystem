<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{

    /**
     * @Route("/")
     */

    public function index()
    {
//            return new Response('<html><body>Product</body></html>');
        $products = ['Produkt1', 'Produkt2', 'Produkt3'];
        return $this->render('/products/index.html.twig', array('products' => $products));
    }
}



