<?php

namespace App\Controller;

use App\Repository\LocalizacionRepository;
use App\Repository\MaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocalizacionController extends AbstractController{

    /**
     * @Route("/localizacion", name="localizacion_listar")
     */
    public function index(LocalizacionRepository $localizacionRepository) : Response{
        $localizaciones = $localizacionRepository->findAllLocalizaciones();
        return $this->render('localizacion/index.html.twig', [
           'localizaciones' => $localizaciones
        ]);
    }

    /**
     * @Route("/localizacion/materiales/{id}", name="localizacion_materiales")
     */
    public function materiales(MaterialRepository $materialRepository,  $id, LocalizacionRepository $localizacionRepository) : Response{
        $localizacion = $localizacionRepository->findOneBy(array('id' => $id));
        $materiales = $materialRepository->findbyLocalizacion($localizacion);
        return $this->render('material/materiales.html.twig', [
            'localizacion' => $localizacion,
            'materiales' => $materiales
        ]);
    }

    /**
     * @Route("/sinpadres", name="localizacion_sinpadre")
     */
    public function localizacionSinPadres(LocalizacionRepository $localizacionRepository) : Response{
        $localizaciones = $localizacionRepository->findLocalizacionSinPadre();
        return $this->render('localizacion/sinpadres.html.twig', [
            'localizaciones' => $localizaciones
        ]);
    }
}