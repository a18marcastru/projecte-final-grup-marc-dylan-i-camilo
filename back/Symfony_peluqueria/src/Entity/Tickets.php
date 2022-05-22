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

    #[ORM\OneToMany(mappedBy: 'ticket', targetEntity: TicketProducto::class)]
    private $ticketProductos;

    public function __construct()
    {
        $this->ticketProductos = new ArrayCollection();
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
     * @return Collection<int, TicketProducto>
     */
    public function getticketProductos(): Collection
    {
        return $this->ticketProductos;
    }

    public function addticketProducto(TicketProducto $ticketProducto): self
    {
        if (!$this->ticketProductos->contains($ticketProducto)) {
            $this->ticketProductos[] = $ticketProducto;
            $ticketProducto->setTicket($this);
        }

        return $this;
    }

    public function removeticketProducto(TicketProducto $ticketProducto): self
    {
        if ($this->ticketProductos->removeElement($ticketProducto)) {
            // set the owning side to null (unless already changed)
            if ($ticketProducto->getTicket() === $this) {
                $ticketProducto->setTicket(null);
            }
        }

        return $this;
    }
}
