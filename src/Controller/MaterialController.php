<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use App\Repository\HistorialRepository;
use App\Repository\MaterialRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{
    /**
     * @Route("/prestamo/material", name="prestamo_material_prestado")
     * @Security("is_granted('ROLE_USUARIO')")
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
     * @Security("is_granted('ROLE_USUARIO')")
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
     * @Security("is_granted('ROLE_USUARIO')")
     */
    public function detalleHistorial(HistorialRepository $historialRepository, Material $material): Response
    {
        $historial = $historialRepository->findByMaterial($material);
        return $this->render('material/historial_detalles.html.twig', [
            'historial' => $historial,
            'material' => $material
        ]);
    }

    /**
     * @Route("/prestamo/material/nuevo", name="material_nuevo")
     * @Security("is_granted('ROLE_GESTOR_PRESTAMOS')")
     */
    public function nuevoMaterial(Request $request, MaterialRepository $materialRepository) : Response
    {
        $material = $materialRepository->create();
        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $materialRepository->save();
                $this->addFlash('exito', 'Se ha creado un nuevo Material');
                return $this->redirectToRoute('prestamo_listado_historial');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al crear...');
            }
        }
        return $this->render('material/form.html.twig', [
            'material' => $material,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/material/modificar/{id}", name="material_modificar")
     * @Security("is_granted('ROLE_GESTOR_PRESTAMOS')")
     */
    public function modificarMaterial(Request $request, MaterialRepository $materialRepository, int $id): Response{
        $material = $materialRepository->findOneBy(array('id' => $id));
        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $materialRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('prestamo_listado_historial');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios...');
            }
        }
        return $this->render('material/form.html.twig', [
            'material' => $material,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/material/eliminar/{id}", name="material_eliminar")
     * @Security("is_granted('ROLE_GESTOR_PRESTAMOS')")
     */
    public function eliminarMaterial(Request $request, MaterialRepository $materialRepository, int $id): Response{
        $material = $materialRepository->findOneBy(array('id' => $id));
        if ($request->get('confirmar', false)) {
            try {
                $materialRepository->delete($material);
                $this->addFlash('exito', 'Material eliminado con éxito');
                return $this->redirectToRoute('prestamo_listado_historial');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se pudo eliminar el material');
            }
        }
        return $this->render('material/eliminar.html.twig', [
            'material' => $material
        ]);
    }
}
