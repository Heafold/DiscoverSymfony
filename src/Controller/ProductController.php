<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    protected $products = [
        ['name' => 'IPhone X', 'slug' => 'iphone-x', 'description' => 'Un IPhone de 2017', 'price' => 999],
        ['name' => 'IPhone XR', 'slug' => 'iphone-xr', 'description' => 'Un IPhone de 2018', 'price' => 1099],
        ['name' => 'IPhone XS', 'slug' => 'iphone-xs', 'description' => 'Un IPhone de 2018', 'price' => 1199],
    ];

    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $this->products,
        ]);
    }

    #[Route('/product/random', name: 'app_product_random')]
    public function random()
    {

        $random = array_rand($this->products, 1);
        dump($random);

        return $this->render('product/random.html.twig', ['product' => $this->products[$random]]);
    }

    #[Route('/product/create', name: 'app_product_create')]
    public function create()
    {
        return $this->render('product/create.html.twig');
    }

    #[Route('/product/{slug}', name: 'app_product_show')]
    public function show($slug)
    {
        foreach ($this->products as $product) {
            if ($product['slug'] === $slug) {
                return $this->render('product/show.html.twig', ['product' => $product]);
            }
        }
        throw $this->createNotFoundException('Le produit n\'existe pas');
    }
}
