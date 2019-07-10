<?php

namespace App\Controller;

use App\Entity\Lien;
use App\Repository\LienRepository;
use App\Repository\PersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DBZController extends AbstractController
{
    /**
     * @Route("/dbz/liste-liens")
     * @param LienRepository $lienRepository
     * @param Request $request
     * @param PersonnageRepository $personnageRepository
     * @return Response
     */
    public function listeLiens(
        LienRepository $lienRepository,
        Request $request,
        PersonnageRepository $personnageRepository
    ): Response
    {
        if ($request->isMethod('post')) {
            $posts = $request->request->all();

            // On enleve x et y
            if (array_key_exists('x', $posts)) {
                unset($posts['x']);
            }
            if (array_key_exists('y', $posts)) {
                unset($posts['y']);
            }

            $persos = $personnageRepository->findAllByLiens($posts);
            /*$persosOk = [];

            foreach ($persos as $perso) {
                $liens = $perso->getLiens();
                $liensOk = array_filter($liens->toArray(), function (Lien $elem) use ($posts) {
                    return in_array($elem->getId(), $posts);
                });
                if (sizeof($liensOk) === sizeof($posts)) {
                    $persosOk[] = $perso;
                }
            }
            dd($persosOk);*/
        }


        return $this->render('dbz/liste-liens.html.twig', [
            'liens' => $lienRepository->findAll()
        ]);
    }

}
