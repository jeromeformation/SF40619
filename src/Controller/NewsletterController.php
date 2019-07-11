<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends AbstractController
{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route("/newsletter", name="newsletter_index")
     */
    public function index(UserRepository $userRepository)
    {
        $users = $userRepository->findAllEmails();


        $this->sendEmailMessage('message');

        return $this->render('newsletter/index.html.twig', [
            'controller_name' => 'NewsletterController',
        ]);
    }


    public function sendEmailMessage(string $message)
    {
        $this->mailer;
    }
}
