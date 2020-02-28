<?php


namespace App\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

class IncomingDeliveryController extends AbstractController
{

//incoming/new
//incoming/id/edit
//incoming/id/delete
//incoming

    /**
     * @Route("/deliveries/incoming", name="incomingDelivery_list")
     */
    public function index()
    {
//        Get all Incoming Deliveries & Sort by id, latest id is the first
        $incomingDeliveries = $this->getDoctrine()->getRepository(IncomingDelivery::class)->findBy([],['id'=>'DESC'] );
//          Pass them to the template so they can get rendered
        return $this->render('incomingDeliveries/allIncomingDeliveries.html.twig', array('incomingDeliveries' => $incomingDeliveries));
    }


    /**
     * @Route("/deliveries/incoming/new", name="incomingDelivery_new")
     * Method({"GET", "POST"})
     */
    public function new(Request $request)
    {

        $incomingDelivery = new IncomingDelivery();

        $form = $this->createFormBuilder($incomingDelivery)
            ->add('invoiceNumber', TextType::class, array('label' => 'Rechnungsnummer', 'attr' => array('class' => 'form-control')))
            ->add('product', EntityType::class, array('class' => 'App\Entity\Product', 'label' => 'Produkt', 'attr' => ['class' => 'form-control']))
            ->add('quantity', NumberType::class, ['html5' => true, 'label' => 'Anzahl', 'attr' => array('class' => 'form-control')])
            ->add('receiptDate', DateTimeType::class, ['input' => 'datetime', 'label' => 'Empfangsdatum'])
            ->add('save', SubmitType::class, ['label' => 'Speichern', 'attr' => ['class' => 'btn btn-primary']])
            ->getForm();

        $form->handleRequest($request);

//        Check if form got submitted and is valid
        if ($form->isSubmitted() && $form->isValid()) {
//            get the submitted data
            $createdIncomingDelivery = $form->getData();

            //UPDATE OF THE ASSOCIATED PRODUCT
            //Get the associated product
            $associatedProduct = $this->getDoctrine()->getRepository(Product::class)->find($createdIncomingDelivery->getProduct());
//            Add the created Delivery to the list of deliverys of the associated product
            $associatedProduct->addIncomingDelivery($createdIncomingDelivery);
//            Increase the quantity of the associated product
            $associatedProduct->addQuantity($createdIncomingDelivery->getQuantity());


//            save the Incoming Delivery to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($createdIncomingDelivery);


            $entityManager->flush();
            return $this->redirectToRoute('incomingDelivery_list');

//            $incomingDelivery = new IncomingDeliveryController();
//            $form = $this->createProductForm($product);
        }

        return $this->render('incomingDeliveries/newIncomingDelivery.html.twig', array('form' => $form->createView()));
//        $this->createFormBuilder($product)
//            ->add('name', TextType::class, array('label' => 'Name', 'attr' => array('class' => 'form-control')))
//            ->add('quantity', NumberType::class, array('html5' => true, 'label' => 'Anzahl', 'attr' => array('class' => 'form-control')))
//            ->add("save", SubmitType::class, array('label' => 'Speichern', 'attr' => array('class' => 'btn btn-primary')))
//            ->getForm();
    }

}