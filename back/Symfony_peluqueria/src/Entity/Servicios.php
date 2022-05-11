<?php

namespace App\Entity;

use App\Repository\ServiciosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiciosRepository::class)]
class Servicios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre_servicio;

    #[ORM\Column(type: 'integer')]
    private $precio;

    #[ORM\OneToMany(mappedBy: 'servicio', targetEntity: ReservaServicio::class)]
    private $reservaServicios;

    public function __construct()
    {
        $this->reservaServicios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreServicio(): ?string
    {
        return $this->nombre_servicio;
    }

    public function setNombreServicio(string $nombre_servicio): self
    {
        $this->nombre_servicio = $nombre_servicio;

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
            $reservaServicio->setServicio($this);
        }

        return $this;
    }

    public function removeReservaServicio(ReservaServicio $reservaServicio): self
    {
        if ($this->reservaServicios->removeElement($reservaServicio)) {
            // set the owning side to null (unless already changed)
            if ($reservaServicio->getServicio() === $this) {
                $reservaServicio->setServicio(null);
            }
        }

        return $this;
    }
}
