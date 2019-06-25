<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Affiche une page HTML
     * @return Response
     */
    public function index(): Response
    {
        //return new Response('<html><body>Bonjour ! </body></html>');
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/contact", name="app_contact")
     * @return Response
     */
    public function contact(): Response
    {
        return $this->render('contact.html.twig');
    }
}
