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

        $em = $doctrine->getManager();
        $em->persist($bestelling);
        $em->flush();

        $this->addFlash('bestellen', "Bestelling: " . $bestelling->getName() . " is ontvangen! We gaan voor u aan de slag!");

        return $this->redirect($this->generateUrl('app_menu'));
    }
}
