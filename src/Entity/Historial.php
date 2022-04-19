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
     */
    private $fechaHoraPrestamo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaHoraDevolucion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notas;

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
}
