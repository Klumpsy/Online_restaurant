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
            $tafel->setStatus('open');

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

    #[Route('/tafel/change_status{id},{status}', name: 'app_tafel_status_change')]
    public function handleStatus($status, $id, ManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();

        $tafel = $em->getRepository(TafelNumber::class)->find($id);

        if (!$tafel) {
            throw $this->createNotFoundException(
                'Sorry, tafel met id ' . $id . ' bestaat niet.'
            );
        }
        $tafel->setStatus($status);
        $em->flush();

        $this->addFlash('tafel_update', 'Tafelstatus is geüpdate.');
        return $this->redirectToRoute('app_tafel_number');
    }

    #[Route('/tafel/delete{id}', name: 'app_tafel_status_delete')]
    public function deleteTafel($id, ManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();
        $tafel = $em->getRepository(TafelNumber::class)->find($id);

        if (!$tafel) {
            throw $this->createNotFoundException(
                'Sorry, tafel met id ' . $id . ' bestaat niet.'
            );
        }

        $em->remove($tafel);
        $em->flush();

        $this->addFlash('tafel_update', 'Tafel is verwijderd');
        return $this->redirectToRoute('app_tafel_number');
    }
}
