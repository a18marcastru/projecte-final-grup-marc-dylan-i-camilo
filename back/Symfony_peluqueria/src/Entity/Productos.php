<?php

namespace App\Entity;

use App\Repository\ProductosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductosRepository::class)]
class Productos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $descripcion;

    #[ORM\Column(type: 'integer')]
    private $cantidad;

    #[ORM\Column(type: 'integer')]
    private $precio;

    #[ORM\Column(type: 'string', length: 255)]
    private $imagen;

    #[ORM\ManyToMany(targetEntity: Tiquets::class, mappedBy: 'producto')]
    private $tiquets;

    public function __construct()
    {
        $this->tiquets = new ArrayCollection();
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

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * @return Collection<int, Tiquets>
     */
    public function getTiquets(): Collection
    {
        return $this->tiquets;
    }

    public function addTiquet(Tiquets $tiquet): self
    {
        if (!$this->tiquets->contains($tiquet)) {
            $this->tiquets[] = $tiquet;
            $tiquet->addProducto($this);
        }

        return $this;
    }

    public function removeTiquet(Tiquets $tiquet): self
    {
        if ($this->tiquets->removeElement($tiquet)) {
            $tiquet->removeProducto($this);
        }

        return $this;
    }
}
