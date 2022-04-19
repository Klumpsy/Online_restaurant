<?php

namespace App\Controller;

use App\Repository\GerechtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(GerechtRepository $gerechtenData): Response
    {

        $gerechten = $gerechtenData->findAll();
        $randomGerecht = array_rand($gerechten, 2);

        return $this->render('home/index.html.twig', [
            'gerecht1' => $gerechten[$randomGerecht[0]],
            'gerecht2' => $gerechten[$randomGerecht[1]],
        ]);
    }
}
