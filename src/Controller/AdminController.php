<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/users")
     * @param UserRepository $repository
     * @return Response
     */
    public function listUser(UserRepository $repository): Response
    {
        return $this->render('admin/user/list.html.twig', [
            'users' => $repository->findAll()
        ]);
    }
}
