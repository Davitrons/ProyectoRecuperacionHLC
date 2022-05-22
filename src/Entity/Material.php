<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponible;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaAlta;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaBaja;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaHoraUltimoPrestamo;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaHoraUltimaDevolucion;

    /**
     * @ORM\ManyToOne(targetEntity=Localizacion::class, inversedBy="materiales")
     * @ORM\JoinColumn(nullable=false)
     */
    private $localizacion;

    /**
     * @ORM\ManyToOne(targetEntity=Persona::class, inversedBy="materiales")
     */
    private $persona;

    /**
     * @ORM\ManyToOne(targetEntity=Persona::class)
     */
    private $prestadoPor;

    /**
     * @ORM\ManyToOne(targetEntity=Persona::class)
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity=Material::class, inversedBy="hijos")
     */
    private $padre;

    /**
     * @ORM\OneToMany(targetEntity=Material::class, mappedBy="padre")
     */
    private $hijos;

    /**
     * @ORM\OneToMany(targetEntity=Historial::class, mappedBy="material")
     */
    private $historico;

    public function __construct()
    {
        $this->hijos = new ArrayCollection();
        $this->historico = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

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

    public function getLocalizacion(): ?Localizacion
    {
        return $this->localizacion;
    }

    public function setLocalizacion(?Localizacion $localizacion): self
    {
        $this->localizacion = $localizacion;

        return $this;
    }

    public function getPersona(): ?Persona
    {
        return $this->persona;
    }

    public function setPersona(?Persona $persona): self
    {
        $this->persona = $persona;

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

    public function getResponsable(): ?Persona
    {
        return $this->responsable;
    }

    public function setResponsable(?Persona $responsable): self
    {
        $this->responsable = $responsable;

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
     * @return Collection<int, Historial>
     */
    public function getHistorico(): Collection
    {
        return $this->historico;
    }

    public function addHistorico(Historial $historico): self
    {
        if (!$this->historico->contains($historico)) {
            $this->historico[] = $historico;
            $historico->setMaterial($this);
        }

        return $this;
    }

    public function removeHistorico(Historial $historico): self
    {
        if ($this->historico->removeElement($historico)) {
            // set the owning side to null (unless already changed)
            if ($historico->getMaterial() === $this) {
                $historico->setMaterial(null);
            }
        }

        return $this;
    }
}
