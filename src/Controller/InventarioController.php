<?php

namespace App\Controller;

use App\Entity\Localizacion;
use App\Entity\Material;
use App\Repository\LocalizacionRepository;
use App\Repository\MaterialRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InventarioController extends AbstractController
{
    /**
     * @Route("/inventario/listar", name="inventario_listar")
     * @Security("is_granted('ROLE_USUARIO')")
     */
    public function index(LocalizacionRepository $localizacionRepository): Response
    {
        $localizaciones = $localizacionRepository->findOrdenados();

        return $this->render('inventario/listar.html.twig', [
            'localizaciones' => $localizaciones
        ]);
    }

    /**
     * @Route("/inventario/listar/{localizacion}", name="inventario_material")
     * @Security("is_granted('ROLE_USUARIO')")
     */
    public function material(MaterialRepository $materialRepository, Localizacion $localizacion): Response
    {
        $materiales = $materialRepository->findByLocalizacion($localizacion);

        return $this->render('inventario/listar_material.html.twig', [
            'localizacion' => $localizacion,
            'materiales' => $materiales
        ]);
    }
}
