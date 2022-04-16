<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class RegistratieController extends AbstractController
{
    #[Route('/registratie', name: 'registratie')]
    public function registration(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): Response
    {
        $registratieForm = $this->createFormBuilder()
            ->add('username', TextType::class, [
                'label' => 'Gebruiker'
            ])->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => ['label' => 'Wachtwoord'],
                'second_options' => ['label' => 'Herhaal Wachtwoord']
            ])->add('registreren', SubmitType::class)
            ->getForm();

        $registratieForm->handleRequest($request);

        if ($registratieForm->isSubmitted() && $registratieForm->isValid()) {
            $input = $registratieForm->getData();
            $user = new User;
            $user->setUsername($input['username']);
            $user->setPassword($passwordHasher->hashPassword($user, $input['password']));

            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('app_login'));
        }

        return $this->render('registratie/index.html.twig', [
            'registratieForm' => $registratieForm->createView(),
        ]);
    }
}
