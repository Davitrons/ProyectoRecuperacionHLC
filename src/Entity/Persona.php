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
     * @ORM\Column(type="string", length=255)
     */
    private $nombreUsuario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clave;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="boolean")
     */
    private $administrador;

    /**
     * @ORM\Column(type="boolean")
     */
    private $gestorPrestamos;

    /**
     * @ORM\OneToMany(targetEntity=Material::class, mappedBy="persona")
     */
    private $materiales;

    public function __construct()
    {
        $this->materiales = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNombre() . ' ' . $this->getApellidos();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Material>
     */
    public function getMateriales(): Collection
    {
        return $this->materiales;
    }

    public function addMateriale(Material $materiale): self
    {
        if (!$this->materiales->contains($materiale)) {
            $this->materiales[] = $materiale;
            $materiale->setPersona($this);
        }

        return $this;
    }

    public function removeMateriale(Material $materiale): self
    {
        if ($this->materiales->removeElement($materiale)) {
            // set the owning side to null (unless already changed)
            if ($materiale->getPersona() === $this) {
                $materiale->setPersona(null);
            }
        }

        return $this;
    }
}
