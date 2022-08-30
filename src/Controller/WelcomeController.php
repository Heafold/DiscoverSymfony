<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    #[Route(path: '/hello', name :'hello')]
    public function index(){
        $name = 'Hortense';
        dump($name);
        return $this->render('welcome/index.html.twig', ['name' => $name]);
    }

    #[Route('/hello/{name}', name: 'hello_show')]
    public function show($name): Response
    {
        return $this->render('welcome/show.html.twig', [
            'name' => ucfirst($name),
        ]);
    }
}
