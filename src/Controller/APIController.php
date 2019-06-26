<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    /**
     * @Route("/api/meteo")
     * @return JsonResponse
     */
    public function meteo(): JsonResponse
    {
        $today = [
            'temp' => 35,
            'unit' => 'celsius',
            'humidity' => '2%'
        ];

        return $this->json($today);
    }

    /**
     * @Route("/meteo")
     * @return RedirectResponse
     */
    public function redirectMeteo(): RedirectResponse
    {
        return $this->redirectToRoute('app_api_meteo');
    }

    /**
     * @Route("/download/pdf")
     * @return BinaryFileResponse
     */
    public function pdf(): BinaryFileResponse
    {
        $pdf = new File('documents/Symfony_best_practices_3.3.pdf');
        return $this->file($pdf, 'sf4.pdf', ResponseHeaderBag::DISPOSITION_INLINE);
    }
}
