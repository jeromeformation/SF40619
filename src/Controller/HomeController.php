<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationMagasinType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Query;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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

    /**
     * @Route("/choice")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function choice(AuthenticationUtils $authenticationUtils): Response
    {
        // Inscription
        $user = new User();
        $form = $this->createForm(RegistrationMagasinType::class, $user);

        // Connexion
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // Vue
        return $this->render('choice.html.twig', [
            'registrationForm' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
}
































