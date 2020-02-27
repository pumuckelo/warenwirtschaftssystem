<?php

namespace App\Controller;


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
     * @Route("/")
     */
    public function index()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();


        return $this->render('/products/index.html.twig', array('products' => $products));
    }


    private function createProductForm(){
        $product = new Product();
//        Create the html form and return it
        return $this->createFormBuilder($product)
            ->add('name', TextType::class, array('label'=>'Name' ,'attr' => array('class' => 'form-control')))
            ->add('quantity', NumberType::class, array('label' =>'Anzahl', 'attr' => array('class' => 'form-control')))
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

        $form = $this->createProductForm();

        $form->handleRequest($request);
//        Check if form got submitted and is valid
        if ($form->isSubmitted() && $form->isValid()){
//            get the submitted data
            $createdProduct = $form->getData();
//            save the data to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($createdProduct);
            $entityManager->flush();

            $form = $this->createProductForm();
        }



        return $this->render('products/newProduct.html.twig', array('form'=>$form->createView()));
    }


    /**
     * @Route("/products/delete/{id}", name="product_delete")
     * Method({"DELETE"})
     */
    public function delete(Request $request,$id){
//        Find the product that needs to be deleted
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
//        Delete the product
        $entityManager  = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();

//        Send a response
        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/products/{id}", name="product_view")
     */
    public function view($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        return $this->render('/products/viewProduct.html.twig', array('product' => $product));
    }
}



