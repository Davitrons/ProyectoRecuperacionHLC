<?php

namespace App\Entity;

use App\Repository\LocalizacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocalizacionRepository::class)
 */
class Localizacion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $codigo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity=Localizacion::class, inversedBy="hijos")
     */
    private $padre;

    /**
     * @ORM\OneToMany(targetEntity=Localizacion::class, mappedBy="padre")
     */
    private $hijos;

    /**
     * @ORM\OneToMany(targetEntity=Material::class, mappedBy="localizacion")
     */
    private $materiales;

    public function __construct()
    {
        $this->hijos = new ArrayCollection();
        $this->materiales = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getCodigo() . ' - ' . $this->getNombre();
    }

    public function getRuta() : string
    {
        $ruta = $this->nombre;
        $actual = $this->padre;
        while ($actual !== null) {
            $ruta = $actual->getNombre() . ' > ' . $ruta;
            $actual = $actual->getPadre();
        }

        return $ruta;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPadre(): ?self
    {
        return $this->padre;
    }

    public function setPadre(?self $padre): self
    {
        $this->padre = $padre;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getHijos(): Collection
    {
        return $this->hijos;
    }

    public function addHijo(self $hijo): self
    {
        if (!$this->hijos->contains($hijo)) {
            $this->hijos[] = $hijo;
            $hijo->setPadre($this);
        }

        return $this;
    }

    public function removeHijo(self $hijo): self
    {
        if ($this->hijos->removeElement($hijo)) {
            // set the owning side to null (unless already changed)
            if ($hijo->getPadre() === $this) {
                $hijo->setPadre(null);
            }
        }

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
            $materiale->setLocalizacion($this);
        }

        return $this;
    }

    public function removeMateriale(Material $materiale): self
    {
        if ($this->materiales->removeElement($materiale)) {
            // set the owning side to null (unless already changed)
            if ($materiale->getLocalizacion() === $this) {
                $materiale->setLocalizacion(null);
            }
        }

        return $this;
    }
}
