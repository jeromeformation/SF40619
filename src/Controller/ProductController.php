<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    /**
     * Liste des produits
     * @Route("/produit/liste")
     * @param ProductRepository $repository
     * @return Response
     */
    public function index(ProductRepository $repository): Response
    {
        // Récupération de tous les produits publiés
        $products = $repository->findBy([
            'isPublished' => true
        ]);
        // Renvoi des produits à la vue
        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * Affiche et traite le formulaire d'ajout d'un produit
     * @Route("/produit/creation", methods={"GET", "POST"})
     * @param Request $requestHTTP
     * @return Response
     */
    public function create(Request $requestHTTP): Response
    {
        // Récupération d'une catégorie
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find(1)
        ;

        // Création et remplissage du produit
        $product = new Product();
        $product
            ->setName('Ventilateur d\'été2')
            ->setDescription('Pour faire du froid')
            ->setImageName('ventilo.jpg')
            ->setIsPublished(true)
            ->setPrice(15.99)
            ->setCategory($category)
        ;

        // On sauvegarde le produit en BDD grâce au manager
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($product);
        $manager->flush();

        return $this->render('product/create.html.twig');
    }

    /**
     * Affiche le détail d'un produit
     * @Route("/produit/{slug<[a-z0-9\-]+>}", methods={"GET", "POST"})
     * @param string $slug
     * @return Response
     */
    public function show(string $slug): Response
    {
        // Génère une erreur 500
        //throw new \Exception('Test Erreur 500');

        // Récupération du repository
        $repository = $this->getDoctrine()->getRepository(Product::class);
        // Récupération du produit lié au slug de l'URL
        $product = $repository->findOneBy([
            'slug' => $slug
        ]);
        // Si on a pas de produit -> page 404
        if (!$product) {
            throw $this->createNotFoundException('Produit non-trouvé !');
        }
        // Renvoi du produit à la vue
        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}
