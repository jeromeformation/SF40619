<?php
namespace App\Controller;

use App\Entity\Commande;
use App\Entity\CommandeProduit;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class BasketController
 * @IsGranted("ROLE_USER")
 */
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

    /**
     * @Route("/panier/validation", name="panier_validate")
     * @param SessionInterface $session
     * @param UserInterface $user
     * @param ProductRepository $productRepository
     * @param ObjectManager $manager
     * @return Response
     * @throws \Exception
     */
    public function validate(
        SessionInterface $session,
        UserInterface $user,
        ProductRepository $productRepository,
        ObjectManager $manager
    ): Response {
        // Création d'une commande
        $commande = new Commande();
        // On associe l'utilisateur connecté à la commande
        $commande->setUser($user);

        // On récupère le panier
        $panier = $session->get('panier', []);
        // On vérifie qu'il y a quelque chose dans le panier
        if (empty($panier)) {
            throw new \Exception('Panier vide');
        }

        $totalPrice = 0;

        // On récupère chaque produit commandé et on le stocke dans une entité
        foreach ($panier as $element) {
            $commandeProduit = new CommandeProduit();
            // On rattache la commande à la table intermédiaire
            $commandeProduit->setCommande($commande);
            // On rattache le produit sélectionné à la table intermédiaire
            $product = $productRepository->find($element['id']);
            if (!$product) {
                throw new \Exception('Produit introuvable');
            }
            $commandeProduit->setProduct($product);
            // On rattache la quantité à la table intermédiaire
            $commandeProduit->setQuantity($element['quantity']);
            // On prépare le SQL pour "commandeProduit"
            $manager->persist($commandeProduit);
            // On met à jour le prix total
            $totalPrice += $element['quantity'] * $product->getPrice();

        }
        // On attribue à la commande son prix total
        $commande->setTotalPrice($totalPrice);
        // On met à jour en BDD
        $manager->persist($commande);
        $manager->flush();

        return $this->redirectToRoute('commande_recap', ['id'=>$commande->getId()]);
    }

    /**
     * @Route("/commande/{id}", name="commande_recap")
     * @param Commande $commande
     * @return Response
     */
    public function recapCommande(Commande $commande): Response
    {
        return $this->render('panier/commande.html.twig', [
            'commande' => $commande
        ]);
    }
}








