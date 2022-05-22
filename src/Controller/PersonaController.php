<?php

namespace App\Controller;

use App\Repository\PersonaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonaController extends AbstractController
{
    /**
     * @Route("/persona/listar", name="persona_listar")
     */
    public function index(PersonaRepository $personaRepository): Response
    {
        $personas = $personaRepository->findSortedByApellidosAndNombre();
        return $this->render('persona/listar.html.twig', [
            'personas' => $personas
        ]);
    }
}
