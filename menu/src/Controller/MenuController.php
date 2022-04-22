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
            $databaseFilter = "";

            switch ($filter) {
                case $filter === 'drinken':
                    $databaseFilter = 1;
                    break;
                case $filter === 'voorgerecht':
                    $databaseFilter = 2;
                    break;
                case $filter === 'hoofdgerecht':
                    $databaseFilter = 3;
                    break;
                case $filter === 'dessert':
                    $databaseFilter = 4;
                    break;
                default:
                    $databaseFilter = "";
            }

            $gerechtenFiltered = $categorie->find($databaseFilter);

            if ($gerechtenFiltered) {
                $gerechten = $gerechtenFiltered->getGerecht();
            } else {
                $gerechten = [];
            }
        } else {
            $gerechten = $gerechtenData->findAll();
        }

        return $this->render('menu/index.html.twig', [
            'gerechten' => $gerechten,
        ]);
    }
}
