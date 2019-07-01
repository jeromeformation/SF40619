<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * @Route("/tags", name="app_tags")
     * @param TagRepository $tagRepository
     * @return Response
     */
    public function list(TagRepository $tagRepository): Response
    {
        return $this->render('tag/list.html.twig', [
            'tags' => $tagRepository->findAll()
        ]);
    }

    /**
     * @Route("/tag/creation", name="app_tag_create")
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($tag);
            $manager->flush();

            $this->addFlash('success', 'Votre tag a bien été ajouté, félicitations !');

            return $this->redirectToRoute('app_tags');
        }

        return $this->render('tag/create.html.twig', [
            'createForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/tag/modification/{id<[0-9]+>}")
     * @param Request $request
     * @param ObjectManager $manager
     * @param Tag $tag
     * @return Response
     */
    public function update(Request $request, ObjectManager $manager, Tag $tag): Response
    {
        $form = $this->createForm(TagType::class, $tag);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            $this->addFlash('warning', 'Tag bien modifié !');

            return $this->redirectToRoute('app_tags');
        }

        return $this->render('tag/update.html.twig', [
            'updateForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/tag/suppression/{id<[0-9]+>}")
     * @param ObjectManager $manager
     * @param Tag $tag
     * @return Response
     */
    public function delete(ObjectManager $manager, Tag $tag): Response
    {
        $manager->remove($tag);
        $manager->flush();

        $this->addFlash('danger', 'Tag supprimé à jamais.... =/');

        return $this->redirectToRoute('app_tags');
    }
}
