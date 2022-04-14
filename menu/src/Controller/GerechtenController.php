<?php

namespace App\Controller;

use App\Entity\Gerecht;
use App\Form\GerechtType;
use App\Repository\GerechtRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gerechten', name: 'gerechten.')]
class GerechtenController extends AbstractController
{
    #[Route('/', name: 'aanpassen')]
    public function index(GerechtRepository $gerechtenData): Response
    {
        $gerechten = $gerechtenData->findAll();

        return $this->render('gerechten/index.html.twig', [
            'gerechten' => array_reverse($gerechten),
        ]);
    }

    #[Route('/maak', name: 'maak')]
    public function create(Request $request, ManagerRegistry $doctrine)
    {
        $gerecht = new Gerecht();

        //Form 
        $form = $this->createForm(GerechtType::class, $gerecht);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            //Entity manager
            $em = $doctrine->getManager();
            $image = $request->files->get('gerecht')['image'];

            if ($image) {
                $imageName = md5(uniqid()) . '.' . $image->guessClientExtension();
            }

            $image->move(
                $this->getParameter('images_folder'),
                $imageName
            );

            $gerecht->setImage($imageName);

            $em->persist($gerecht);
            $em->flush();

            return $this->redirect($this->generateUrl('gerechten.aanpassen'));
        }

        //Response 
        return $this->render('gerechten/maak.html.twig', [
            'gerechtForm' => $form->createView()
        ]);
    }

    #[Route('/delete{id}', name: 'delete')]
    public function delete($id, GerechtRepository $gerechtData, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $gerecht = $gerechtData->find($id);
        $em->remove($gerecht);
        $em->flush();

        $this->addFlash('succes', "Gerecht is succesvol verwijderd");

        return $this->redirect($this->generateUrl('gerechten.aanpassen'));
    }

    #[Route('/show{id}', name: 'show')]
    public function showPicture(Gerecht $gerecht)
    {
        return $this->render('gerechten/showImage.html.twig', [
            'gerecht' => $gerecht,
        ]);
    }
}
