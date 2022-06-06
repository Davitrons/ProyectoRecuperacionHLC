<?php

namespace App\Controller;

use App\Entity\Localizacion;
use App\Form\LocalizacionType;
use App\Repository\LocalizacionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LocalizacionController extends AbstractController
{
    /**
     * @Route("/localizacion/{raiz}", name="localizacion_listar", requirements={"raiz"="\d+"})
     * @Security("is_granted('ROLE_USUARIO')")
     */
    public function index(LocalizacionRepository $localizacionRepository, Localizacion $raiz = null): Response
    {
        $localizaciones = $localizacionRepository->findByPadre($raiz);
        return $this->render('localizacion/listar.html.twig', [
            'localizaciones' => $localizaciones,
            'raiz' => $raiz
        ]);
    }

    /**
     * @Route("/localizacion/nuevo", name="localizacion_nuevo")
     * @Security("is_granted('ROLE_ADMINISTRADOR')")
     */
    public function nuevaLocalizacion(Request $request, LocalizacionRepository $localizacionRepository) : Response
    {
        $localizacion = $localizacionRepository->create();
        $form = $this->createForm(LocalizacionType::class, $localizacion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $localizacionRepository->save();
                $this->addFlash('exito', 'Se ha creado una nueva Localizacion');
                return $this->redirectToRoute('localizacion_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al crear...');
            }
        }
        return $this->render('localizacion/form.html.twig', [
            'localizacion' => $localizacion,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/localizacion/modificar/{id}", name="localizacion_modificar")
     * @Security("is_granted('ROLE_ADMINISTRADOR')")
     */
    public function modificarLocalizacion(Request $request, LocalizacionRepository $localizacionRepository, int $id): Response{
        $localizacion = $localizacionRepository->findOneBy(array('id' => $id));
        $form = $this->createForm(LocalizacionType::class, $localizacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $localizacionRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('localizacion_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios...');
            }
        }
        return $this->render('localizacion/form.html.twig', [
            'localizacion' => $localizacion,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/localizacion/eliminar/{id}", name="localizacion_eliminar")
     * @Security("is_granted('ROLE_ADMINISTRADOR')")
     */
    public function eliminarLocalizacion(Request $request, LocalizacionRepository $localizacionRepository, int $id): Response{
        $localizacion = $localizacionRepository->findOneBy(array('id' => $id));
        if ($request->get('confirmar', false)) {
            try {
                $localizacionRepository->delete($localizacion);
                $this->addFlash('exito', 'Localizacion eliminada con éxito');
                return $this->redirectToRoute('localizacion_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se pudo eliminar la localizacion');
            }
        }
        return $this->render('localizacion/eliminar.html.twig', [
            'localizacion' => $localizacion
        ]);
    }
}
