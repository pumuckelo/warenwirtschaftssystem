<?php

namespace App\Controller;


use App\Entity\IncomingDelivery;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{

    /**
     * @Route("/products", name="product_list")
     * @Route("/")
     */
    public function index()
    {
//        Find all products
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
//        Pass all products to the /products page so they can get rendered
        return $this->render('/products/index.html.twig', array('products' => $products));
    }


    private function createProductForm(Product $product)
    {

//        Create the html form and return it
        return $this->createFormBuilder($product)
            ->add('name', TextType::class, array('label' => 'Name', 'attr' => array('class' => 'form-control')))
            ->add('quantity', NumberType::class, array('html5' => true, 'label' => 'Anzahl', 'attr' => array('class' => 'form-control')))
            ->add("save", SubmitType::class, array('label' => 'Speichern', 'attr' => array('class' => 'btn btn-primary')))
            ->getForm();
    }

    /**
     * @Route("/products/new", name="product_new")
     * Method({"GET", "POST"})
     */
    public function new(Request $request)
    {


//      Create the HTML Form
//        $form = $this->createFormBuilder($product)
//            ->add('name', TextType::class, array('label'=>'Name' ,'attr' => array('class' => 'form-control')))
//            ->add('quantity', NumberType::class, array('label' =>'Anzahl', 'attr' => array('class' => 'form-control')))
//            ->add("save", SubmitType::class, array('label' => 'Speichern', 'attr'
// => array('class' => 'btn btn-primary mt-2')))
//            ->getForm();
        $product = new Product();
        $form = $this->createProductForm($product);

        $form->handleRequest($request);
//        Check if form got submitted and is valid
        if ($form->isSubmitted() && $form->isValid()) {
//            get the submitted data
            $createdProduct = $form->getData();
//            save the data to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($createdProduct);
            $entityManager->flush();

            $product = new Product();
            $form = $this->createProductForm($product);
            return $this->redirectToRoute('product_list');
        }


        return $this->render('products/newProduct.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/products/{id}/delete", name="product_delete")
     * Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
//        Find the product that needs to be deleted
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
//        Delete the product
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();

//        Send a response
        $response = new Response(Response::HTTP_OK);
        $response->send();
    }

    /**
     * @Route("/products/{id}/edit", name="product_edit")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id)
    {
//        Find the product that needs to be updated
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        $form = $this->createProductForm($product);
        $form->handleRequest($request);


        //check if form is submitted, if yes change the data in database
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('product_list');
        }


        //render the template and pass the form object so we can display it on the template
        return $this->render('products/editProduct.html.twig', array('form' => $form->createView()));


    }

    /**
     * @Route("/products/{id}", name="product_view")
     */
    public function view($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);


        //Get all the incomingDeliveries for that product
        $incomingDeliveries = $this->getDoctrine()->getRepository(IncomingDelivery::class)->findBy(['product'=> $id]);

        return $this->render('/products/viewProduct.html.twig', array('product' => $product, 'incomingDeliveries'=>$incomingDeliveries));
    }
}



