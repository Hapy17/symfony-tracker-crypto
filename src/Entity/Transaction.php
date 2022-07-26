<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $occuredAt = null;

    #[ORM\Column]
    private ?float $ammount = null;

    #[ORM\Column]
    private ?float $fee = null;

    #[ORM\Column]
    private ?int $status = null;

    #[ORM\ManyToOne(inversedBy: 'recieverTransactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TokenUser $reciever = null;

    #[ORM\ManyToOne(inversedBy: 'senderTransactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TokenUser $sender = null;

    #[ORM\ManyToOne(inversedBy: 'tokenTransactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Token $token = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOccuredAt(): ?\DateTimeInterface
    {
        return $this->occuredAt;
    }

    public function setOccuredAt(\DateTimeInterface $occuredAt): self
    {
        $this->occuredAt = $occuredAt;

        return $this;
    }

    public function getAmmount(): ?float
    {
        return $this->ammount;
    }

    public function setAmmount(float $ammount): self
    {
        $this->ammount = $ammount;

        return $this;
    }

    public function getFee(): ?float
    {
        return $this->fee;
    }

    public function setFee(float $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getReciever(): ?TokenUser
    {
        return $this->reciever;
    }

    public function setReciever(?TokenUser $reciever): self
    {
        $this->reciever = $reciever;

        return $this;
    }

    public function getSender(): ?TokenUser
    {
        return $this->sender;
    }

    public function setSender(?TokenUser $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getToken(): ?Token
    {
        return $this->token;
    }

    public function setToken(?Token $token): self
    {
        $this->token = $token;

        return $this;
    }
}
