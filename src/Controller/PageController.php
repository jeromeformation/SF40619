<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     * @return Response
     */
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig');
    }
}

