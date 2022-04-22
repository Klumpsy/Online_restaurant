<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;


class MailerController extends AbstractController
{
    #[Route('/mail', name: 'app_mailer')]
    public function sendMail(MailerInterface $mailer)
    {
        $email = (new TemplatedEmail())
            ->from('Bart_klumperman@live.nl')
            ->to('Ober@gmail.com')
            ->subject('Bestelling')
            ->text('extra frietjes')
            ->htmlTemplate('mailer/mail.html.twig');

        $mailer->send($email);

        return new Response('Email send');
    }
}
