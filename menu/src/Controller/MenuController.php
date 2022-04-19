<?php

namespace App\Controller;

use App\Repository\GerechtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menukaart', name: 'app_menu')]
    public function menukaart(GerechtRepository $gerechtenData): Response
    {
        $gerechten = $gerechtenData->findAll();

        return $this->render('menu/index.html.twig', [
            'gerechten' => $gerechten,
        ]);
    }
}
