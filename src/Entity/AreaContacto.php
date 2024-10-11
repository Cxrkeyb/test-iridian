<?php

namespace App\Entity;

use App\Repository\AreaContactoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AreaContactoRepository::class)]
class AreaContacto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, MensajeContacto>
     */
    #[ORM\OneToMany(targetEntity: MensajeContacto::class, mappedBy: 'areaContacto')]
    private Collection $mensajeContactos;

    public function __construct()
    {
        $this->mensajeContactos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, MensajeContacto>
     */
    public function getMensajeContactos(): Collection
    {
        return $this->mensajeContactos;
    }

    public function addMensajeContacto(MensajeContacto $mensajeContacto): static
    {
        if (!$this->mensajeContactos->contains($mensajeContacto)) {
            $this->mensajeContactos->add($mensajeContacto);
            $mensajeContacto->setAreaContacto($this);
        }

        return $this;
    }

    public function removeMensajeContacto(MensajeContacto $mensajeContacto): static
    {
        if ($this->mensajeContactos->removeElement($mensajeContacto)) {
            // set the owning side to null (unless already changed)
            if ($mensajeContacto->getAreaContacto() === $this) {
                $mensajeContacto->setAreaContacto(null);
            }
        }

        return $this;
    }
}
