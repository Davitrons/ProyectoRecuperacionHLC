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
     * @ORM\ManyToOne(targetEntity=Material::class, inversedBy="historico")
     * @ORM\JoinColumn(nullable=false)
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity=Persona::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestadoA;

    /**
     * @ORM\ManyToOne(targetEntity=Persona::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestadoPor;

    /**
     * @ORM\ManyToOne(targetEntity=Persona::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $devueltoPor;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaHoraPrestamo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaHoraDevolucion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getPrestadoA(): ?Persona
    {
        return $this->prestadoA;
    }

    public function setPrestadoA(?Persona $prestadoA): self
    {
        $this->prestadoA = $prestadoA;

        return $this;
    }

    public function getPrestadoPor(): ?Persona
    {
        return $this->prestadoPor;
    }

    public function setPrestadoPor(?Persona $prestadoPor): self
    {
        $this->prestadoPor = $prestadoPor;

        return $this;
    }

    public function getDevueltoPor(): ?Persona
    {
        return $this->devueltoPor;
    }

    public function setDevueltoPor(?Persona $devueltoPor): self
    {
        $this->devueltoPor = $devueltoPor;

        return $this;
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
}
