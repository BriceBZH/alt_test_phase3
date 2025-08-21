<?php

namespace App\Entity;

use App\Repository\CostTrackingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CostTrackingRepository::class)]
class CostTracking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tools $tool = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $monthYear = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $totalMonthlyCost = null;

    #[ORM\Column]
    private ?int $activeUsersCount = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTool(): ?Tools
    {
        return $this->tool;
    }

    public function setTool(?Tools $tool): static
    {
        $this->tool = $tool;

        return $this;
    }

    public function getMonthYear(): ?\DateTime
    {
        return $this->monthYear;
    }

    public function setMonthYear(\DateTime $monthYear): static
    {
        $this->monthYear = $monthYear;

        return $this;
    }

    public function getTotalMonthlyCost(): ?string
    {
        return $this->totalMonthlyCost;
    }

    public function setTotalMonthLyCost(string $totalMonthlyCost): static
    {
        $this->totalMonthlyCost = $totalMonthlyCost;

        return $this;
    }

    public function getActiveUsersCount(): ?int
    {
        return $this->activeUsersCount;
    }

    public function setActiveUsersCount(int $activeUsersCount): static
    {
        $this->activeUsersCount = $activeUsersCount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
