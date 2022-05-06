<?php

namespace App\Entity;

use App\Repository\TiquetsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TiquetsRepository::class)]
class Tiquets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $precio_total;

    #[ORM\ManyToOne(targetEntity: Usuarios::class, inversedBy: 'tiquets')]
    #[ORM\JoinColumn(nullable: false)]
    private $usuario;

    #[ORM\ManyToMany(targetEntity: Productos::class, inversedBy: 'tiquets')]
    private $producto;

    #[ORM\Column(type: 'string', length: 255)]
    private $fecha;

    public function __construct()
    {
        $this->producto = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecioTotal(): ?int
    {
        return $this->precio_total;
    }

    public function setPrecioTotal(int $precio_total): self
    {
        $this->precio_total = $precio_total;

        return $this;
    }

    public function getUsuario(): ?Usuarios
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuarios $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection<int, Productos>
     */
    public function getProducto(): Collection
    {
        return $this->producto;
    }

    public function addProducto(Productos $producto): self
    {
        if (!$this->producto->contains($producto)) {
            $this->producto[] = $producto;
        }

        return $this;
    }

    public function removeProducto(Productos $producto): self
    {
        $this->producto->removeElement($producto);

        return $this;
    }

    public function getFecha(): ?string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }
}
