<?php

namespace App\Controller;

use App\Repository\LocalizacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocalizacionController extends AbstractController{

    /**
     * @Route("/localizacion", name="localizacion_listar")
     */
    public function index(LocalizacionRepository $localizacionRepository) : Response{
        $localizaciones = $localizacionRepository->findAll();
        return $this->render('localizacion/index.html.twig', [
           'localizaciones' => $localizaciones
        ]);
    }
}