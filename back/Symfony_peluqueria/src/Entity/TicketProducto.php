<?php

namespace App\Entity;

use App\Repository\TicketProductoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketProductoRepository::class)]
class TicketProducto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $cantidades;

    #[ORM\ManyToOne(targetEntity: Tickets::class, inversedBy: 'comprars')]
    #[ORM\JoinColumn(nullable: false)]
    private $ticket;

    #[ORM\ManyToOne(targetEntity: Productos::class, inversedBy: 'comprars')]
    #[ORM\JoinColumn(nullable: false)]
    private $producto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidades(): ?int
    {
        return $this->cantidades;
    }

    public function setCantidades(int $cantidades): self
    {
        $this->cantidades = $cantidades;

        return $this;
    }

    public function getTicket(): ?Tickets
    {
        return $this->ticket;
    }

    public function setTicket(?Tickets $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getProducto(): ?Productos
    {
        return $this->producto;
    }

    public function setProducto(?Productos $producto): self
    {
        $this->producto = $producto;

        return $this;
    }
}
