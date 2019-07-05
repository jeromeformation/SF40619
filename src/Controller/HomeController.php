<?php
namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Query;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Affiche une page HTML
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param ObjectManager $manager
     * @return Response
     */
    public function index(
        Request $request,
        PaginatorInterface $paginator,
        ObjectManager $manager
    ): Response {
        // Création d'un objet Query à partir du DQL
        $query = new Query($manager);
        $dql = "SELECT p FROM App\Entity\Product AS p";

        $query->setDQL($dql);

        // Récupération de la pagination
        $paginatedResults = $paginator->paginate(
            $query, // Requête SQL de base
            $request->query->getInt('page', 1), // $_GET['page']
            9 // Nombre de produits par page
        );

        return $this->render('index.html.twig', [
            'paginatedResults' => $paginatedResults
        ]);
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
