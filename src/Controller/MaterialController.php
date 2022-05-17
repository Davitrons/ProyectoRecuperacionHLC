<?php

namespace App\Controller;

use App\Repository\HistorialRepository;
use App\Repository\MaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController{

    /**
     * @Route("/materialesprestados", name="material_prestado")
     */
    public function obtenerMateriales(MaterialRepository $materialRepository) : Response{
        $materiales = $materialRepository->findMaterialesPrestados();
            return $this->render('material/materialesprestados.html.twig', [
                'materiales' => $materiales
            ]);
    }

    /**
     * @Route("/materiales", name="material_listar")
     */
    public function index(MaterialRepository $materialRepository) : Response{
        $materiales = $materialRepository->findAllMateriales();
        return $this->render('material/index.html.twig', [
            'materiales' => $materiales
        ]);
    }

    /**
     * @Route("/materiales/historial/{id}", name="material_historico")
     */
    public function materiales(MaterialRepository $materialRepository,  $id, HistorialRepository $historialRepository) : Response{
        $material = $materialRepository->findOneBy(array('id' => $id));
        $historiales = $historialRepository->findHistorial($material);
        return $this->render('historial/index.html.twig', [
            'material' => $material,
            'historiales' => $historiales
        ]);
    }

}