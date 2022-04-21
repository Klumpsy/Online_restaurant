<?php

namespace App\Controller;

use App\Entity\Bestelling;
use App\Entity\Gerecht;
use App\Repository\BestellingRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BestellingController extends AbstractController
{
    #[Route('/bestelling', name: 'app_bestelling')]
    public function index(BestellingRepository $bestellingRepository): Response
    {

        $bestelling = $bestellingRepository->findBy(
            ['tafel' => 'tafel1']
        );
        return $this->render('bestelling/index.html.twig', [
            'bestellingen' => $bestelling,
        ]);
    }

    #[Route('/bestellen/{id}', name: 'app_bestellen')]
    public function bestellen(Gerecht $gerecht, ManagerRegistry $doctrine)
    {
        $bestelling = new Bestelling();
        $bestelling->setTafel('Tafel1');
        $bestelling->setBestelnummer('1');
        $bestelling->setName($gerecht->getGerecht());
        $bestelling->setPrijs($gerecht->getPrijs());
        $bestelling->setStatus('open');

        //Entity manager 
        $em = $doctrine->getManager();
        $em->persist($bestelling);
        $em->flush();

        $this->addFlash('bestellen', "Bestelling: " . $bestelling->getName() . " is ontvangen! We gaan voor u aan de slag!");

        return $this->redirect($this->generateUrl('app_menu'));
    }

    #[Route('/status/{id},{status}', name: 'status')]
    public function status($id, $status, ManagerRegistry $doctrine)
    {
        //Entity manager
        $em = $doctrine->getManager();
        $bestelling = $em->getRepository(Bestelling::class)->find($id);

        $bestelling->setStatus($status);
        $em->flush();

        $this->addFlash('status', "Status van bestelling: " . $bestelling->getName() . " is aangepast.");

        return $this->redirect($this->generateUrl('app_bestelling'));
    }

    #[Route('/delete{id}', name: 'delete')]
    public function delete($id, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $bestelling = $em->getRepository(Bestelling::class)->find($id);
        $em->remove($bestelling);
        $em->flush();

        $this->addFlash('delete', "Gerecht is succesvol verwijderd");

        return $this->redirect($this->generateUrl('app_bestelling'));
    }
}
