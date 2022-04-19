<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterialRepository::class)
 */
class Material
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaHoraUltimoPrestamo;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaHoraUltimaDevolucion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponible;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaAlta;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaBaja;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFechaHoraUltimoPrestamo(): ?\DateTimeInterface
    {
        return $this->fechaHoraUltimoPrestamo;
    }

    public function setFechaHoraUltimoPrestamo(?\DateTimeInterface $fechaHoraUltimoPrestamo): self
    {
        $this->fechaHoraUltimoPrestamo = $fechaHoraUltimoPrestamo;

        return $this;
    }

    public function getFechaHoraUltimaDevolucion(): ?\DateTimeInterface
    {
        return $this->fechaHoraUltimaDevolucion;
    }

    public function setFechaHoraUltimaDevolucion(?\DateTimeInterface $fechaHoraUltimaDevolucion): self
    {
        $this->fechaHoraUltimaDevolucion = $fechaHoraUltimaDevolucion;

        return $this;
    }

    public function getDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getFechaAlta(): ?\DateTimeInterface
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta(?\DateTimeInterface $fechaAlta): self
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    public function getFechaBaja(): ?\DateTimeInterface
    {
        return $this->fechaBaja;
    }

    public function setFechaBaja(?\DateTimeInterface $fechaBaja): self
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }
}