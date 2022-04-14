<?php
namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{

    /**
     * @Route("/email")
     */
    public function sendEmail(MailerInterface $mailer)
    {
        $email=(new TemplatedEmail())
        ->from('sakshigoraniya13@gmail.com')
        ->to('sakshigoraniya13@gmail.com')
        ->subject('you order has been placed')
        ->context([
            'expiration_date' => new \DateTime('+7 days'),
            'username' => 'foo',
        ])
        
        ->attachFromPath('/home/sakshigoraniya/Documents/projectideas.odt')
        ->embedFromPath('/home/sakshigoraniya/Pictures/logo.png', 'logo')
        ->html('<img src="cid:logo">')
        ->htmltemplate('emails/signup.html.twig')
        ;

        $mailer->send($email);

        return new Response('email sent');

    }
    
}