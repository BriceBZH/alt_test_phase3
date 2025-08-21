<?php

namespace App\Entity;

use App\Repository\AccessRequestsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccessRequestsRepository::class)]
class AccessRequests
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tools $tool = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $businessJustification = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $requestedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $processedAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "processed_by", nullable: true)]
    private ?Users $processedBy = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $processingNotes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
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

    public function getBusinessJustification(): ?string
    {
        return $this->businessJustification;
    }

    public function setBusinessJustification(string $businessJustification): static
    {
        $this->businessJustification = $businessJustification;

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

    public function getRequestedAt(): ?\DateTimeImmutable
    {
        return $this->requestedAt;
    }

    public function setRequestedAt(\DateTimeImmutable $requestedAt): static
    {
        $this->requestedAt = $requestedAt;

        return $this;
    }

    public function getProcessedAt(): ?\DateTimeImmutable
    {
        return $this->processedAt;
    }

    public function setProcessedAt(?\DateTimeImmutable $processedAt): static
    {
        $this->processedAt = $processedAt;

        return $this;
    }

    public function getProcessedBy(): ?Users
    {
        return $this->processedBy;
    }

    public function setProcessedBy(?Users $processedBy): static
    {
        $this->processedBy = $processedBy;

        return $this;
    }

    public function getProcessingNotes(): ?string
    {
        return $this->processingNotes;
    }

    public function setProcessingNotes(?string $processingNotes): static
    {
        $this->processingNotes = $processingNotes;

        return $this;
    }
}
