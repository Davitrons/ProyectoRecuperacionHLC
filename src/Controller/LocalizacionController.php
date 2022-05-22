<?php

namespace App\Controller;

use App\Entity\Localizacion;
use App\Repository\LocalizacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocalizacionController extends AbstractController
{
    /**
     * @Route("/localizacion/{raiz}", name="localizacion_listar", requirements={"raiz"="\d+"})
     */
    public function index(LocalizacionRepository $localizacionRepository, Localizacion $raiz = null): Response
    {
        $localizaciones = $localizacionRepository->findByPadre($raiz);
        return $this->render('localizacion/listar.html.twig', [
            'localizaciones' => $localizaciones,
            'raiz' => $raiz
        ]);
    }
}
