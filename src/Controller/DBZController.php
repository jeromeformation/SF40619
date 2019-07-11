<?php

namespace App\Controller;

use App\Entity\Lien;
use App\Repository\LienRepository;
use App\Repository\todoPersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DBZController extends AbstractController
{
    /**
     * @Route("/dbz/liste-liens", name="dbz_liste_liens")
     * @param LienRepository $lienRepository
     * @param Request $request
     * @param todoPersonnageRepository $personnageRepository
     * @return Response
     */
    public function listeLiens(
        LienRepository $lienRepository,
        Request $request,
        todoPersonnageRepository $personnageRepository
    ): Response {
        // Récupération des persos
        if ($request->isMethod('post')) {
            $posts = $request->request->all();

            // On enleve x et y
            if (array_key_exists('x', $posts)) {
                unset($posts['x']);
            }
            if (array_key_exists('y', $posts)) {
                unset($posts['y']);
            }

            $persos = $personnageRepository->findAll();
            $persosOk = [];

            foreach ($persos as $perso) {
                $liens = $perso->getLiens();
                $liensOk = array_filter($liens->toArray(), function (Lien $elem) use ($posts) {
                    return in_array($elem->getId(), $posts);
                });
                if (sizeof($liensOk) === sizeof($posts)) {
                    $persosOk[] = $perso;
                }
            }
        }

        // Tri des persos
        $filter = $request->query->get('filter', 'name');

        if ($filter === 'ki') {
            $orderBy = [
                'ki' => 'ASC',
                'name' => 'ASC'
            ];
        } else {
            $orderBy = ['name' => 'ASC'];
        }

        return $this->render('dbz/liste-liens.html.twig', [
            'liens' => $lienRepository->findBy([], $orderBy),
            'persos' => $persosOk ?? []
        ]);
    }

}
