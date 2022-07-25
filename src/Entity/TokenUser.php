<?php

namespace App\Entity;

use App\Repository\TokenUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TokenUserRepository::class)]
class TokenUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $quantity = null;

    #[ORM\Column(length: 255)]
    private ?string $walletAddress = null;

    #[ORM\OneToMany(mappedBy: 'reciever', targetEntity: Transaction::class)]
    private Collection $recieverTransactions;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: Transaction::class)]
    private Collection $senderTransactions;

    #[ORM\ManyToMany(targetEntity: Token::class, inversedBy: 'tokenUsers')]
    private Collection $token;

    #[ORM\ManyToOne(inversedBy: 'userTokenUsers')]
    private ?User $user = null;

    public function __construct()
    {
        $this->recieverTransactions = new ArrayCollection();
        $this->senderTransactions = new ArrayCollection();
        $this->token = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getWalletAddress(): ?string
    {
        return $this->walletAddress;
    }

    public function setWalletAddress(string $walletAddress): self
    {
        $this->walletAddress = $walletAddress;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getRecieverTransactions(): Collection
    {
        return $this->recieverTransactions;
    }

    public function addRecieverTransaction(Transaction $recieverTransaction): self
    {
        if (!$this->recieverTransactions->contains($recieverTransaction)) {
            $this->recieverTransactions[] = $recieverTransaction;
            $recieverTransaction->setReciever($this);
        }

        return $this;
    }

    public function removeRecieverTransaction(Transaction $recieverTransaction): self
    {
        if ($this->recieverTransactions->removeElement($recieverTransaction)) {
            // set the owning side to null (unless already changed)
            if ($recieverTransaction->getReciever() === $this) {
                $recieverTransaction->setReciever(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getSenderTransactions(): Collection
    {
        return $this->senderTransactions;
    }

    public function addSenderTransaction(Transaction $senderTransaction): self
    {
        if (!$this->senderTransactions->contains($senderTransaction)) {
            $this->senderTransactions[] = $senderTransaction;
            $senderTransaction->setSender($this);
        }

        return $this;
    }

    public function removeSenderTransaction(Transaction $senderTransaction): self
    {
        if ($this->senderTransactions->removeElement($senderTransaction)) {
            // set the owning side to null (unless already changed)
            if ($senderTransaction->getSender() === $this) {
                $senderTransaction->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Token>
     */
    public function getToken(): Collection
    {
        return $this->token;
    }

    public function addToken(Token $token): self
    {
        if (!$this->token->contains($token)) {
            $this->token[] = $token;
        }

        return $this;
    }

    public function removeToken(Token $token): self
    {
        $this->token->removeElement($token);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
