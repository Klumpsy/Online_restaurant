<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use App\Repository\GerechtRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menukaart/{filter?}', name: 'app_menu')]
    public function menukaart(string $filter = null, GerechtRepository $gerechtenData, CategorieRepository $categorie): Response
    {
        if ($filter !== null) {
            $gerechtenFiltered = $gerechtenData->findBy(['gerecht' => 'Biefstuk']);

            $gerechten = $gerechtenFiltered;
        } else {
            $gerechten = $gerechtenData->findAll();
        }

        return $this->render('menu/index.html.twig', [
            'gerechten' => $gerechten,
        ]);
    }
}
