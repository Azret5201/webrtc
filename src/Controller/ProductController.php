<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @Route("/create_product", name="create_product")
     */
    public function create() : Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();

        $product->setName('Keyboard');
        $product->setPrice('2000');
        $product->setDescription('Ergonomic and stylish');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        return new Response('Saved new product with new id '.$product->getId());


    }
}
