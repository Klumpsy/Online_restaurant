<?php

namespace App\Controller;

use App\Entity\TafelNumber;
use App\Form\TafelType;
use App\Repository\TafelNumberRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TafelNumberController extends AbstractController
{
    #[Route('/tafel/create', name: 'app_tafel_number')]
    public function createTable(Request $request, ManagerRegistry $doctrine, TafelNumberRepository $tafelData): Response
    {
        $tafel = new TafelNumber;
        $tableForm = $this->createForm(TafelType::class, $tafel);

        $tableForm->handleRequest($request);

        if ($tableForm->isSubmitted() && $tableForm->isValid()) {
            $input = $tableForm->getData();

            $em = $doctrine->getManager();
            $em->persist($tafel);
            $em->flush();

            $this->addFlash('tafel', 'Tafel is toegevoegd.');
            return $this->redirect($this->generateUrl('app_tafel_number'));
        }

        $allTafels = $tafelData->findAll();

        return $this->render('tafel_number/index.html.twig', [
            'addTableForm' => $tableForm->createView(),
            'tafels' => $allTafels,
        ]);
    }
}
