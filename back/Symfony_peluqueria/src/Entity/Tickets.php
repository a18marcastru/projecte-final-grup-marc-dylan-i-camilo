<?php

namespace App\Entity;

use App\Repository\TicketsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketsRepository::class)]
class Tickets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $fecha;

    #[ORM\Column(type: 'integer')]
    private $precio_total;

    #[ORM\ManyToOne(targetEntity: Usuarios::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private $usuario;

    #[ORM\OneToMany(mappedBy: 'ticket', targetEntity: Comprar::class)]
    private $comprars;

    public function __construct()
    {
        $this->comprars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $comprar->setTicket($this);
        }

        return $this;
    }

    public function removeComprar(Comprar $comprar): self
    {
        if ($this->comprars->removeElement($comprar)) {
            // set the owning side to null (unless already changed)
            if ($comprar->getTicket() === $this) {
                $comprar->setTicket(null);
            }
        }

        return $this;
    }
}
