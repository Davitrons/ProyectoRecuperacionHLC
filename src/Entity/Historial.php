<?php

namespace App\Entity;

use App\Repository\HistorialRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistorialRepository::class)
 */
class Historial
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $fechaHoraPrestamo;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $fechaHoraDevolucion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $notas;

    /**
     * @ORM\ManyToOne(targetEntity="Material", inversedBy="historico")
     * @var Material
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumn(nullable=false)
     * @var Persona
     */
    private $prestadoPor;

    /**
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumn(nullable=false)
     * @var Persona
     */
    private $prestadoA;

    /**
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumn(nullable=false)
     * @var Persona
     */
    private $devueltoPor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaHoraPrestamo(): ?\DateTimeInterface
    {
        return $this->fechaHoraPrestamo;
    }

    public function setFechaHoraPrestamo(\DateTimeInterface $fechaHoraPrestamo): self
    {
        $this->fechaHoraPrestamo = $fechaHoraPrestamo;

        return $this;
    }

    public function getFechaHoraDevolucion(): ?\DateTimeInterface
    {
        return $this->fechaHoraDevolucion;
    }

    public function setFechaHoraDevolucion(\DateTimeInterface $fechaHoraDevolucion): self
    {
        $this->fechaHoraDevolucion = $fechaHoraDevolucion;

        return $this;
    }

    public function getNotas(): ?string
    {
        return $this->notas;
    }

    public function setNotas(?string $notas): self
    {
        $this->notas = $notas;

        return $this;
    }

    /**
     * @return Material
     */
    public function getMaterial(): Material
    {
        return $this->material;
    }

    /**
     * @param Material $material
     * @return Historial
     */
    public function setMaterial(Material $material): Historial
    {
        $this->material = $material;
        return $this;
    }

    /**
     * @return Persona
     */
    public function getPrestadoPor(): Persona
    {
        return $this->prestadoPor;
    }

    /**
     * @param Persona $prestadoPor
     * @return Historial
     */
    public function setPrestadoPor(Persona $prestadoPor): Historial
    {
        $this->prestadoPor = $prestadoPor;
        return $this;
    }

    /**
     * @return Persona
     */
    public function getPrestadoA(): Persona
    {
        return $this->prestadoA;
    }

    /**
     * @param Persona $prestadoA
     * @return Historial
     */
    public function setPrestadoA(Persona $prestadoA): Historial
    {
        $this->prestadoA = $prestadoA;
        return $this;
    }

    /**
     * @return Persona
     */
    public function getDevueltoPor(): Persona
    {
        return $this->devueltoPor;
    }

    /**
     * @param Persona $devueltoPor
     * @return Historial
     */
    public function setDevueltoPor(Persona $devueltoPor): Historial
    {
        $this->devueltoPor = $devueltoPor;
        return $this;
    }

}
