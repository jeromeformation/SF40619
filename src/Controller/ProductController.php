<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * Affiche le détail d'un produit
     * @Route("/produit/{slug<[a-z0-9\-]+>}", methods={"GET", "POST"})
     * @param string $slug
     * @return Response
     */
    public function show(string $slug): Response
    {
        var_dump($slug);
        dump($slug);

        return $this->render('product/show.html.twig');
    }
}
