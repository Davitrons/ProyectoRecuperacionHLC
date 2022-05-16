<?php

namespace App\Controller;

use App\Repository\PersonaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonaController extends AbstractController{

    /**
     * @Route("/personas", name="personas_listado")
     */
    public function index(PersonaRepository $personaRepository) : Response{
        $personas = $personaRepository->findUsariosOrdenadosApellidoNombreConMaterialResponsable();
        dump($personas);
        return $this->render('persona/index.html.twig', [
            'personas' => $personas
        ]);
    }
}