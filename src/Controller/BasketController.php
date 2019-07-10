<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    /**
     * Ajoute un produit dans la session
     * @Route("/panier/ajout", name="app_basket_add")
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function addProductToBasket(Request $request, SessionInterface $session): Response
    {
        // Récupération des variables postées
        $posts = $request->request->all();

        // Récupération des produits déjà en session
        $products = $session->get('panier', []);
        $products[] = $posts;

        // Mise en session
        $session->set('panier', $products);

        return $this->redirectToRoute('app_product_index');
    }

    /**
     * @Route("/panier", name="app_panier")
     * @return Response
     */
    public function panier(): Response
    {
        return $this->render('panier/recap.html.twig');
    }
}








