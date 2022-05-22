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

    #[ORM\OneToMany(mappedBy: 'producto', targetEntity: TicketProducto::class)]
    private $comprars;

    public function __construct()
    {
        $this->comprars = new ArrayCollection();
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
     * @return Collection<int, Comprar>
     */
    public function getComprars(): Collection
    {
        return $this->comprars;
    }

    public function addComprar(Comprar $comprar): self
    {
        if (!$this->comprars->contains($comprar)) {
            $this->comprars[] = $comprar;
            $comprar->setProducto($this);
        }

        return $this;
    }

    public function removeComprar(Comprar $comprar): self
    {
        if ($this->comprars->removeElement($comprar)) {
            // set the owning side to null (unless already changed)
            if ($comprar->getProducto() === $this) {
                $comprar->setProducto(null);
            }
        }

        return $this;
    }

}
