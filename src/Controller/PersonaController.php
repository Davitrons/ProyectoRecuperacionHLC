<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Form\PersonaType;
use App\Repository\PersonaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/persona/nuevo", name="persona_nuevo")
     */
    public function nuevaPersona(Request $request, PersonaRepository $personaRepository) : Response
    {
        $persona = $personaRepository->create();
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $personaRepository->save();
                $this->addFlash('exito', 'Se ha creado una nueva Persona');
                return $this->redirectToRoute('persona_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al crear...');
            }
        }
        return $this->render('persona/form.html.twig', [
            'persona' => $persona,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/persona/{id}", name="persona_modificar")
     */
    public function modificarPersona(Request $request, PersonaRepository $personaRepository, int $id): Response{
        $persona = $personaRepository->findOneBy(array('id' => $id));
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $personaRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('persona_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios...');
            }
        }
        return $this->render('persona/form.html.twig', [
            'persona' => $persona,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/persona/eliminar/{id}", name="persona_eliminar")
     */
    public function eliminarPersona(Request $request, PersonaRepository $personaRepository, int $id): Response{
        $persona = $personaRepository->findOneBy(array('id' => $id));
        if ($request->get('confirmar', false)) {
            try {
                $personaRepository->delete($persona);
                $this->addFlash('exito', 'Persona eliminada con éxito');
                return $this->redirectToRoute('persona_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se pudo eliminar la persona');
            }
        }
        return $this->render('persona/eliminar.html.twig', [
            'persona' => $persona
        ]);
    }
}
