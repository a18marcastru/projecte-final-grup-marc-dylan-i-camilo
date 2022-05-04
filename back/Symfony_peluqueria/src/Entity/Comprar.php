<?php

namespace App\Entity;

use App\Repository\ComprarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComprarRepository::class)]
class Comprar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $precio_base;

    #[ORM\Column(type: 'integer')]
    private $precio_total;

    #[ORM\Column(type: 'integer')]
    private $cantidad_total;

    #[ORM\Column(type: 'date')]
    private $fecha;

    #[ORM\ManyToOne(targetEntity: Usuarios::class, inversedBy: 'comprars')]
    #[ORM\JoinColumn(nullable: false)]
    private $usuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecioBase(): ?int
    {
        return $this->precio_base;
    }

    public function setPrecioBase(int $precio_base): self
    {
        $this->precio_base = $precio_base;

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

    public function getCantidadTotal(): ?int
    {
        return $this->cantidad_total;
    }

    public function setCantidadTotal(int $cantidad_total): self
    {
        $this->cantidad_total = $cantidad_total;

        return $this;
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

    public function getUsuario(): ?Usuarios
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuarios $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
