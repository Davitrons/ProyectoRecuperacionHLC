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
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $codigo;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Localizacion",inversedBy="hijos")
     * @ORM\JoinColumn(nullable=true)
     * @var ?Localizacion
     */
    private $padre;

    /**
     * @ORM\OneToMany(targetEntity="Localizacion", mappedBy="padre")
     * @var ?Localizacion[]|Collection
     */
    private $hijos;

    /**
     * @ORM\OneToMany(targetEntity="Material", mappedBy="localizacion")
     * @var ?Material[]|Collection
     */
    private $materiales;

    public function __construct()
    {
        $this->hijos = new ArrayCollection();
        $this->materiales = new ArrayCollection();
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

    /**
     * @return Localizacion|null
     */
    public function getPadre(): ?Localizacion
    {
        return $this->padre;
    }

    /**
     * @param Localizacion|null $padre
     * @return Localizacion
     */
    public function setPadre(?Localizacion $padre): Localizacion
    {
        $this->padre = $padre;
        return $this;
    }

    /**
     * @return Localizacion[]|Collection|null
     */
    public function getHijos()
    {
        return $this->hijos;
    }

    /**
     * @param Localizacion[]|Collection|null $hijos
     * @return Localizacion
     */
    public function setHijos($hijos)
    {
        $this->hijos = $hijos;
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
     * @return Localizacion
     */
    public function setMateriales($materiales)
    {
        $this->materiales = $materiales;
        return $this;
    }

}
