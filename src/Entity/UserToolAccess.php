<?php

namespace App\Entity;

use App\Repository\UserToolAccessRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserToolAccessRepository::class)]
class UserToolAccess
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

    #[ORM\Column]
    private ?\DateTimeImmutable $grantedAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "granted_by", nullable: false)]
    private ?Users $grantedBy = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $revokedAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "revoked_by")]
    private ?Users $revokedBy = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

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

    public function getGrantedAt(): ?\DateTimeImmutable
    {
        return $this->grantedAt;
    }

    public function setGrantedAt(\DateTimeImmutable $grantedAt): static
    {
        $this->grantedAt = $grantedAt;

        return $this;
    }

    public function getGrantedBy(): ?Users
    {
        return $this->grantedBy;
    }

    public function setGrantedBy(?Users $grantedBy): static
    {
        $this->grantedBy = $grantedBy;

        return $this;
    }

    public function getRevokedAt(): ?\DateTimeImmutable
    {
        return $this->revokedAt;
    }

    public function setRevokedAt(?\DateTimeImmutable $revokedAt): static
    {
        $this->revokedAt = $revokedAt;

        return $this;
    }

    public function getRevokedBy(): ?Users
    {
        return $this->revokedBy;
    }

    public function setRevokedBy(?Users $revokedBy): static
    {
        $this->revokedBy = $revokedBy;

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
}
