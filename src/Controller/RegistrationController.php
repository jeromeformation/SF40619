<?php

namespace App\Controller;

use App\Entity\Professionnel;
use App\Entity\User;
use App\Form\RegistrationClientType;
use App\Form\RegistrationMagasinType;
use App\Form\RegistrationProType;
use App\Security\AppAuthAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param AppAuthAuthenticator $authenticator
     * @return Response
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        AppAuthAuthenticator $authenticator
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationMagasinType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($request->request);

            $datas = $request->request->get('registration_form', []);

            if (array_key_exists('rolesFalse', $datas)) {
                $user->setRoles([$datas['rolesFalse']]);
            }

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email


            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }/**
     * @Route("/register/pro", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param AppAuthAuthenticator $authenticator
     * @return Response
     */
    public function registerPro(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        AppAuthAuthenticator $authenticator
    ): Response {
        $user = new Professionnel();
        $form = $this->createForm(RegistrationProType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($request->request);

            $datas = $request->request->get('registration_form', []);

            if (array_key_exists('rolesFalse', $datas)) {
                $user->setRoles([$datas['rolesFalse']]);
            }

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email


            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register-pro.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/client", name="register_client")
     * @param Request $request
     * @return Response
     */
    public function registerClient(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationClientType::class, $user);

        // Traitement du formulaire

        return $this->render('registration/register-client.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}

















