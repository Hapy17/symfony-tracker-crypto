<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TokenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TokenRepository::class)]
#[ApiResource]

class Token
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $rank = null;

    #[ORM\Column]
    private ?int $maxSupply = null;

    #[ORM\Column]
    private ?int $circulatingSupply = null;

    #[ORM\Column(length: 255)]
    private ?string $blockchainType = null;

    #[ORM\OneToMany(mappedBy: 'token', targetEntity: Transaction::class)]
    private Collection $tokenTransactions;

    #[ORM\ManyToMany(targetEntity: TokenUser::class, mappedBy: 'token')]
    private Collection $tokenUsers;

    public function __construct()
    {
        $this->tokenTransactions = new ArrayCollection();
        $this->tokenUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getMaxSupply(): ?int
    {
        return $this->maxSupply;
    }

    public function setMaxSupply(int $maxSupply): self
    {
        $this->maxSupply = $maxSupply;

        return $this;
    }

    public function getCirculatingSupply(): ?int
    {
        return $this->circulatingSupply;
    }

    public function setCirculatingSupply(int $circulatingSupply): self
    {
        $this->circulatingSupply = $circulatingSupply;

        return $this;
    }

    public function getBlockchainType(): ?string
    {
        return $this->blockchainType;
    }

    public function setBlockchainType(string $blockchainType): self
    {
        $this->blockchainType = $blockchainType;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getTokenTransactions(): Collection
    {
        return $this->tokenTransactions;
    }

    public function addTokenTransaction(Transaction $tokenTransaction): self
    {
        if (!$this->tokenTransactions->contains($tokenTransaction)) {
            $this->tokenTransactions[] = $tokenTransaction;
            $tokenTransaction->setToken($this);
        }

        return $this;
    }

    public function removeTokenTransaction(Transaction $tokenTransaction): self
    {
        if ($this->tokenTransactions->removeElement($tokenTransaction)) {
            // set the owning side to null (unless already changed)
            if ($tokenTransaction->getToken() === $this) {
                $tokenTransaction->setToken(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TokenUser>
     */
    public function getTokenUsers(): Collection
    {
        return $this->tokenUsers;
    }

    public function addTokenUser(TokenUser $tokenUser): self
    {
        if (!$this->tokenUsers->contains($tokenUser)) {
            $this->tokenUsers[] = $tokenUser;
            $tokenUser->addToken($this);
        }

        return $this;
    }

    public function removeTokenUser(TokenUser $tokenUser): self
    {
        if ($this->tokenUsers->removeElement($tokenUser)) {
            $tokenUser->removeToken($this);
        }

        return $this;
    }
}
