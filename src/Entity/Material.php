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
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $descripcion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime|null
     */
    private $fechaHoraUltimoPrestamo;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime|null
     */
    private $fechaHoraUltimaDevolucion;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $disponible;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime|null
     */
    private $fechaAlta;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime|null
     */
    private $fechaBaja;

    /**
     * @ORM\ManyToOne(targetEntity="Material",inversedBy="hijos")
     * @ORM\JoinColumn(nullable=true)
     * @var ?Material
     */
    private $padre;

    /**
     * @ORM\OneToMany(targetEntity="Material", mappedBy="padre")
     * @var ?Material[]|Collection
     */
    private $hijos;

    /**
     * @ORM\ManyToOne(targetEntity="Localizacion", inversedBy="materiales")
     * @var Localizacion
     */
    private $localizacion;

    /**
     * @ORM\OneToMany(targetEntity="Historial", mappedBy="material")
     * @var ?Historial[]|Collection
     */
    private $historico;

    /**
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="materiales")
     * @var ?Persona
     */
    private $persona;

    /**
     * @ORM\ManyToOne(targetEntity="Persona")
     * @var ?Persona
     */
    private $prestadoPor;

    /**
     * @ORM\ManyToOne(targetEntity="Persona")
     * @var ?Persona
     */
    private $responsable;

    public function __construct(){
        $this->hijos = new ArrayCollection();
        $this->historico = new ArrayCollection();
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

    /**
     * @return Material|null
     */
    public function getPadre(): ?Material
    {
        return $this->padre;
    }

    /**
     * @param Material|null $padre
     * @return Material
     */
    public function setPadre(?Material $padre): Material
    {
        $this->padre = $padre;
        return $this;
    }

    /**
     * @return Material[]|Collection|null
     */
    public function getHijos()
    {
        return $this->hijos;
    }

    /**
     * @param Material[]|Collection|null $hijos
     * @return Material
     */
    public function setHijos($hijos)
    {
        $this->hijos = $hijos;
        return $this;
    }

    /**
     * @return Localizacion
     */
    public function getLocalizacion(): Localizacion
    {
        return $this->localizacion;
    }

    /**
     * @param Localizacion $localizacion
     * @return Material
     */
    public function setLocalizacion(Localizacion $localizacion): Material
    {
        $this->localizacion = $localizacion;
        return $this;
    }

    /**
     * @return Historial[]|Collection|null
     */
    public function getHistorico()
    {
        return $this->historico;
    }

    /**
     * @param Historial[]|Collection|null $historico
     * @return Material
     */
    public function setHistorico($historico)
    {
        $this->historico = $historico;
        return $this;
    }

    /**
     * @return Persona|null
     */
    public function getPersona(): ?Persona
    {
        return $this->persona;
    }

    /**
     * @param Persona|null $persona
     * @return Material
     */
    public function setPersona(?Persona $persona): Material
    {
        $this->persona = $persona;
        return $this;
    }

    /**
     * @return Persona|null
     */
    public function getPrestadoPor(): ?Persona
    {
        return $this->prestadoPor;
    }

    /**
     * @param Persona|null $prestadoPor
     * @return Material
     */
    public function setPrestadoPor(?Persona $prestadoPor): Material
    {
        $this->prestadoPor = $prestadoPor;
        return $this;
    }

    /**
     * @return Persona|null
     */
    public function getResponsable(): ?Persona
    {
        return $this->responsable;
    }

    /**
     * @param Persona|null $responsable
     * @return Material
     */
    public function setResponsable(?Persona $responsable): Material
    {
        $this->responsable = $responsable;
        return $this;
    }

}
