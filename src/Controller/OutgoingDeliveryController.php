<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\IncomingDelivery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Product;

class OutgoingDeliveryController extends AbstractController {

    /**
     * @Route("/deliveries/outgoing", name="outgoingDeliveries_list" )
     */
        public function index(){

            return $this->render('outgoingDeliveries/allOutgoingDeliveries.html.twig');
        }
    //incoming/new
//incoming/id/edit
//incoming/id/delete
//incoming
}