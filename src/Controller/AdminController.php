<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditRoleUserType;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    public function listUser(UserRepository $repository): Response
    {
        return $this->render('admin/user/list.html.twig', [
            'users' => $repository->findAll()
        ]);
    }

    /**
     * @param User $user
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function changeRole(User $user, Request $request, ObjectManager $manager): Response
    {
        $form = $this->createForm(EditRoleUserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            $this->addFlash(
                'success',
                'Nouveaux rôles de ' . $user->getEmail() . ' : ' . implode(', ', $user->getRoles())
            );
            return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('admin/user/change-role.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}
