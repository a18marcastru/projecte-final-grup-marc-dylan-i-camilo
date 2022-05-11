<?php

namespace App\Entity;

use App\Repository\ReservasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservasRepository::class)]
class Reservas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $fecha;

    #[ORM\Column(type: 'time')]
    private $hora;

    #[ORM\Column(type: 'integer')]
    private $telefono;

    #[ORM\ManyToOne(targetEntity: Usuarios::class, inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private $usuario;

    #[ORM\OneToMany(mappedBy: 'reserva', targetEntity: ReservaServicio::class)]
    private $reservaServicios;

    public function __construct()
    {
        $this->reservaServicios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getHora(): ?\DateTimeInterface
    {
        return $this->hora;
    }

    public function setHora(\DateTimeInterface $hora): self
    {
        $this->hora = $hora;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): self
    {
        $this->telefono = $telefono;

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
     * @return Collection<int, ReservaServicio>
     */
    public function getReservaServicios(): Collection
    {
        return $this->reservaServicios;
    }

    public function addReservaServicio(ReservaServicio $reservaServicio): self
    {
        if (!$this->reservaServicios->contains($reservaServicio)) {
            $this->reservaServicios[] = $reservaServicio;
            $reservaServicio->setReserva($this);
        }

        return $this;
    }

    public function removeReservaServicio(ReservaServicio $reservaServicio): self
    {
        if ($this->reservaServicios->removeElement($reservaServicio)) {
            // set the owning side to null (unless already changed)
            if ($reservaServicio->getReserva() === $this) {
                $reservaServicio->setReserva(null);
            }
        }

        return $this;
    }
}
