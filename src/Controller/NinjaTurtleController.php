<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NinjaTurtleController extends AbstractController
{

    protected $turtles = [
        ['name' => 'Raphaël', 'color' => 'red', 'size' => 2],
        ['name' => 'Léonardo', 'color' => 'blue', 'size' => 2],
        ['name' => 'Donatello', 'color' => 'purple', 'size' => 3],
        ['name' => 'Michelangelo', 'color' => 'orange', 'size' => 4],
    ];


    #[Route('/ninja-turtle', name: 'app_ninja_turtle')]
    public function index(Request $request): Response
    {
        dump($request->get('size'));

        // Filtrer le tableau avec le size passé en URL
        if ($request->get('size')) {
            $this->turtles = array_filter($this->turtles, function ($turtle) use ($request) {
                return $turtle['size'] === (int) $request->get('size');
            });
        }


        return $this->render('ninja_turtle/index.html.twig', [
            'turtles' => $this->turtles,
        ]);
    }
    #[Route('/ninja-turtle/{color}', name: 'app_ninja_turtle_show')]
    public function show($color)
    {
        foreach ($this->turtles as $turtle) {
            if ($turtle['color'] === $color) {
                return $this->render('ninja_turtle/show.html.twig', ['turtle' => $turtle]);
            }
        }

        // Si on ne trouve pas la tortue, on affiche une 404
        throw $this->createNotFoundException('La tortue n\'existe pas');
    }
}
