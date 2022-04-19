<?php
namespace App\Controller;


use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Notifier\Recipient\Recipient;

class EmailController extends AbstractController
{

    /**
     * @Route("/email")
     */
    public function sendEmail(MailerInterface $mailer,NotifierInterface $notifier)
    {
        $to='sakshigoraniya13@gmail.com';
        $email=(new TemplatedEmail())
        ->from($to)
        ->to('sakshigoraniya13@gmail.com')
        ->subject('you order has been placed')
        ->context([
            'expiration_date' => new \DateTime('+7 days'),
            'username' => 'foo',
        ])
      
        ->attachFromPath('/home/sakshigoraniya/Documents/projectideas.odt')
        ->embedFromPath('/home/sakshigoraniya/Pictures/logo.png', 'logo')
        #->html('<img src="cid:logo">')
        ->htmltemplate('emails/welcome.html.twig')
        ;
        //dd($email);
        
        $mailer->send($email);


        $notification = (new Notification('New Invoice', ['email']))
            ->content('You got a new invoice for 15 EUR.');
        $recipient = new Recipient($to);
        $notifier->send($notification, $recipient);
        return new Response('email sent');

    }
     /**
     * @Route("/welcome")
     */
    public function HomePage(MailerInterface $mailer)
    {
       
        return $this->render('emails/welcome.html.twig');

    }
    
    /**
     * @Route("/", name="app_homepage")
     */
    public function welcomepage()
    {
    
        return $this->render('emails/index.html.twig');
    }
}