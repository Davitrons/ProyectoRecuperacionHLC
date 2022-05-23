<?php

namespace App\Controller;

use App\Entity\Material;
use App\Repository\HistorialRepository;
use App\Repository\MaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{
    /**
     * @Route("/prestamo/material", name="prestamo_material_prestado")
     */
    public function index(MaterialRepository $materialRepository): Response
    {
        $materiales = $materialRepository->findPrestados();
        return $this->render('material/prestado.html.twig', [
            'materiales' => $materiales
        ]);
    }

    /**
     * @Route("/prestamo/listado", name="prestamo_listado_historial")
     */
    public function listado(MaterialRepository $materialRepository): Response
    {
        $materiales = $materialRepository->findOrdenados();
        return $this->render('material/historial_listado.html.twig', [
            'materiales' => $materiales
        ]);
    }

    /**
     * @Route("/prestamo/detalles/{material}", name="prestamo_detalle_historial")
     */
    public function detalleHistorial(HistorialRepository $historialRepository, Material $material): Response
    {
        $historial = $historialRepository->findByMaterial($material);
        return $this->render('material/historial_detalles.html.twig', [
            'historial' => $historial,
            'material' => $material
        ]);
    }
}
