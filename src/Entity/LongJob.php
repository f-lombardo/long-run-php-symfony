<?php

namespace App\Entity;

use App\Repository\LongJobRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LongJobRepository::class)]
class LongJob
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $status;

    #[ORM\Column(type: 'text')]
    private $initial_data;

    #[ORM\Column(type: 'text', nullable: true)]
    private $final_data;

    #[ORM\Column(type: 'datetimetz')]
    private $started_on;

    #[ORM\Column(type: 'datetimetz', nullable: true)]
    private $ended_at;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getInitialData(): ?string
    {
        return $this->initial_data;
    }

    public function setInitialData(string $initial_data): self
    {
        $this->initial_data = $initial_data;

        return $this;
    }

    public function getFinalData(): ?string
    {
        return $this->final_data;
    }

    public function setFinalData(?string $final_data): self
    {
        $this->final_data = $final_data;

        return $this;
    }

    public function getStartedOn(): ?\DateTimeInterface
    {
        return $this->started_on;
    }

    public function setStartedOn(\DateTimeInterface $started_on): self
    {
        $this->started_on = $started_on;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->ended_at;
    }

    public function setEndedAt(?\DateTimeInterface $ended_at): self
    {
        $this->ended_at = $ended_at;

        return $this;
    }
}
