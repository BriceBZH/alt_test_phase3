<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ToolsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Enum\ToolStatus;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToolsRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read:tools', 'read:categories']],
    paginationItemsPerPage : 1,
    operations: [
        new GetCollection(normalizationContext: ['groups' => ['read:tools', 'read:categories']]),
        new Get(normalizationContext: ['groups' => ['read:item', 'read:categories']]),
        new Patch(denormalizationContext: ['groups' => ['put:item']]),
    ]
)]
#[ApiFilter(SearchFilter::class, properties: [
    'ownerDepartment' => 'exact',
    'status' => 'exact',
    'id' => 'exact',
    'category.name' => 'exact',
])]
// #[ApiFilter(RangeFilter::class, properties: [
//     'monthly_cost',
// ])]
// #[ApiFilter(OrderFilter::class, properties: [
//     'name', 'id', 'description'
// ], arguments: ['orderParameterName' => 'order'])]

class Tools
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:tools', 'read:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['read:tools', 'read:item'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['read:tools', 'read:item', 'put:item'])]
    private ?string $description = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['read:tools', 'read:item'])]
    private ?string $vendor = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:tools', 'read:item'])]
    private ?string $websiteUrl = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:tools', 'read:item'])]
    private ?Categories $category = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['read:tools', 'read:item', 'put:item'])]
    private ?string $monthlyCost = null;

    #[ORM\Column]
    #[Groups(['read:tools', 'read:item'])]
    private ?int $activeUsersCount = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:tools', 'read:item'])]
    private ?string $ownerDepartment = null;

    #[ORM\Column(enumType: ToolStatus::class, nullable: true)]
    #[Groups(['read:tools', 'read:item', 'put:item'])]
    private ?ToolStatus $status = ToolStatus::Active;

    #[ORM\Column]
    #[Groups(['read:tools', 'read:item'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups(['read:tools', 'read:item'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'tool', targetEntity: UsageLogs::class)]
    private Collection $usageLogs;

    public function __construct()
    {
        $this->usageLogs = new ArrayCollection();
    }

    public function getUsageLogs(): Collection
    {
        return $this->usageLogs;
    }

    #[Groups(['read:item'])]
    public function getUsageMetrics(): array
    {
        $now = new \DateTimeImmutable();
        $date = $now->modify('-30 days');

        $logs = $this->usageLogs;

        $totalSessions = count($logs);
        $totalMinutes = 0;
        foreach ($logs as $log) {
            $totalMinutes += $log->getUsageMinutes();
        }
        $avgMinutes = $totalSessions > 0 ? round($totalMinutes / $totalSessions) : 0;

        return [
            'last_30_days' => [
                'total_sessions' => $totalSessions,
                'avg_session_minutes' => $avgMinutes
            ]
        ];
    }

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

    public function getStatus(): ?ToolStatus
    {
        return $this->status;
    }

    public function setStatus(?ToolStatus $status): self
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
