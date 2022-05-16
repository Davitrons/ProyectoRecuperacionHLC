<?php

namespace App\Entity;

use App\Repository\PersonaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonaRepository::class)
 */
class Persona
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @var string
     */
    private $nombreUsuario;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $clave;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $apellidos;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $administrador;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $gestorPrestamos;

    /**
     * @ORM\OneToMany(targetEntity="Material", mappedBy="persona")
     * @var ?Material[]|Collection
     */
    private $materiales;

    public function __construct(){
        $this->materiales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->nombre . ' ' . $this->apellidos;
    }


    public function getNombreUsuario(): ?string
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario(string $nombreUsuario): self
    {
        $this->nombreUsuario = $nombreUsuario;

        return $this;
    }

    public function getClave(): ?string
    {
        return $this->clave;
    }

    public function setClave(string $clave): self
    {
        $this->clave = $clave;

        return $this;
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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getAdministrador(): ?bool
    {
        return $this->administrador;
    }

    public function setAdministrador(bool $administrador): self
    {
        $this->administrador = $administrador;

        return $this;
    }

    public function getGestorPrestamos(): ?bool
    {
        return $this->gestorPrestamos;
    }

    public function setGestorPrestamos(bool $gestorPrestamos): self
    {
        $this->gestorPrestamos = $gestorPrestamos;

        return $this;
    }

    /**
     * @return Material[]|Collection|null
     */
    public function getMateriales()
    {
        return $this->materiales;
    }

    /**
     * @param Material[]|Collection|null $materiales
     * @return Persona
     */
    public function setMateriales($materiales)
    {
        $this->materiales = $materiales;
        return $this;
    }

}
