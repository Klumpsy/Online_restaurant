<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    #[Route('/view', name: 'app_view')]
    public function index(): Response
    {
        $day = date("l");

        $user = [
            'name' => 'Bart',
            'surname' => 'Klumpers',
            'age' => 30,
            'town' => 'Sibculo'
        ];

        $array = array(1, 2, 3, 4, 5);

        return $this->render('view/index.html.twig', [
            'day' => $day,
            'user' => $user,
            'array' => $array
        ]);
    }
}
