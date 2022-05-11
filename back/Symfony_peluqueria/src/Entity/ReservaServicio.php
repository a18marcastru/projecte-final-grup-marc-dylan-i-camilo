<?php

namespace App\Entity;

use App\Repository\ReservaServicioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaServicioRepository::class)]
class ReservaServicio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Servicios::class, inversedBy: 'reservaServicios')]
    #[ORM\JoinColumn(nullable: false)]
    private $servicio;

    #[ORM\ManyToOne(targetEntity: Reservas::class, inversedBy: 'reservaServicios')]
    #[ORM\JoinColumn(nullable: false)]
    private $reserva;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServicio(): ?Servicios
    {
        return $this->servicio;
    }

    public function setServicio(?Servicios $servicio): self
    {
        $this->servicio = $servicio;

        return $this;
    }

    public function getReserva(): ?Reservas
    {
        return $this->reserva;
    }

    public function setReserva(?Reservas $reserva): self
    {
        $this->reserva = $reserva;

        return $this;
    }
}
