<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use App\Repository\ToolsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToolsRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['tools:read']],
    denormalizationContext: ['groups' => ['tools:write']],
    paginationEnabled: false,
    operations: [
        new Get(),
        new GetCollection()
    ]
)]
#[ApiFilter(SearchFilter::class, properties: [
    'ownerDepartment' => 'exact',
    'status' => 'exact',
    'id' => 'exact',
])]
#[ApiFilter(RangeFilter::class, properties: [
    'monthly_cost',
])]
#[ApiFilter(OrderFilter::class, properties: [
    'monthly_cost', 'name', 'created_at'
], arguments: ['orderParameterName' => 'order'])]

class Tools
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['tools:read', 'tools:write'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['tools:read', 'tools:write'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['tools:read', 'tools:write'])]
    private ?string $description = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['tools:read', 'tools:write'])]
    private ?string $vendor = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['tools:read', 'tools:write'])]
    private ?string $websiteUrl = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['tools:read', 'tools:write'])]
    private ?Categories $category = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['tools:read', 'tools:write'])]
    private ?string $monthlyCost = null;

    #[ORM\Column]
    #[Groups(['tools:read', 'tools:write'])]
    private ?int $activeUsersCount = null;

    #[ORM\Column(length: 255)]
    #[Assert\Choice(['Engineering','Sales','Marketing','HR','Finance','Operations','Design'])]
    #[Groups(['tools:read'])]
    private ?string $ownerDepartment = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Choice(['active','deprecated','trial'])]
    #[Groups(['tools:read'])]
    private ?string $status = 'active';

    #[ORM\Column]
    #[Groups(['tools:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups(['tools:read'])]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    public function setVendor(?string $vendor): static
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(?string $websiteUrl): static
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getMonthlyCost(): ?string
    {
        return $this->monthlyCost;
    }

    public function setMonthlyCost(string $monthlyCost): static
    {
        $this->monthlyCost = $monthlyCost;

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

    public function getOwnerDepartment(): ?string
    {
        return $this->ownerDepartment;
    }

    public function setOwnerDepartment(string $ownerDepartment): static
    {
        $this->ownerDepartment = $ownerDepartment;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
