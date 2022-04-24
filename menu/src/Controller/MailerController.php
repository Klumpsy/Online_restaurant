<?php

namespace App\Controller;

use App\Entity\TafelNumber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    #[Route('/mail', name: 'app_mailer')]
    public function sendMail(MailerInterface $mailer, Request $request): Response
    {
        $emailForm = $this->createFormBuilder()
            ->add('tafelNr', EntityType::class, [
                'class' => TafelNumber::class,
                'choice_label' => 'tafelNr'
            ])
            ->add('bericht', TextareaType::class, [
                'attr' => ['rows' => '5']
            ])
            ->add('verzenden', SubmitType::class)
            ->getForm();

        $emailForm->handleRequest($request);

        if ($emailForm->isSubmitted()) {
            $input = $emailForm->getData();
            //Check how to get values from TafelNumber class
            $tafel = $input['tafelNr']->getTafelnr();
            $text = $input['bericht'];

            $email = (new TemplatedEmail())
                ->from('Bart_klumperman@live.nl')
                ->to('Ober@gmail.com')
                ->subject('Bestelling')

                ->htmlTemplate('mailer/mail.html.twig')

                ->context([
                    'tafel' => $tafel,
                    'text' => $text
                ]);

            $mailer->send($email);

            $this->addFlash('bericht', 'Het bericht is verstuurd, we komen zo snel mogelijk bij u.');
            return $this->redirect($this->generateUrl('app_mailer'));
        }
        return $this->render('mailer/index.html.twig', [
            'emailForm' => $emailForm->createView()
        ]);
    }
}
