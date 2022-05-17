<?php

namespace App\Controller;

use App\Repository\MaterialRepository;
use App\Repository\HistorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController{

    /**
     * @Route("/materiales", name="material_prestado")
     */
    public function obtenerMateriales(MaterialRepository $materialRepository) : Response{
        $materiales = $materialRepository->findMaterialesPrestados();
            return $this->render('material/materialesprestados.html.twig', [
                'materiales' => $materiales
            ]);
    }

}