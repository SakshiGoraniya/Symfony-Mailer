<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:author-weekly-report:send',
    description: 'Send weekly reports to authors',
)]
class AuthorWeeklyReportSendCommand extends Command
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        parent::__construct(null);
        $this->mailer = $mailer;
    }
    protected function configure(): void
    {
        $this
        ->setDescription('Send weekly reports to authors')
    ;

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
       
      

      
        $email = (new TemplatedEmail())
                ->from('sakshigoraniya13@gmail.com')
                ->to('sakshigoraniya13@gmail.com')
                ->subject('Your weekly report on the Space Bar!')
                ->htmlTemplate('emails/author-weekly-report.html.twig');
            $this->mailer->send($email);
        
    
        $io->success('Weekly reports were sent to authors!');
        return Command::SUCCESS;
    }
}
