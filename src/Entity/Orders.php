<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $userid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tax;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $paymenttype;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shipcompany;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shipname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shipaddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shiptel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shipinf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $createat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $updateat;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(?int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getTax(): ?float
    {
        return $this->tax;
    }

    public function setTax(?float $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getPaymenttype(): ?string
    {
        return $this->paymenttype;
    }

    public function setPaymenttype(?string $paymenttype): self
    {
        $this->paymenttype = $paymenttype;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getShipcompany(): ?string
    {
        return $this->shipcompany;
    }

    public function setShipcompany(?string $shipcompany): self
    {
        $this->shipcompany = $shipcompany;

        return $this;
    }

    public function getShipname(): ?string
    {
        return $this->shipname;
    }

    public function setShipname(?string $shipname): self
    {
        $this->shipname = $shipname;

        return $this;
    }

    public function getShipaddress(): ?string
    {
        return $this->shipaddress;
    }

    public function setShipaddress(?string $shipaddress): self
    {
        $this->shipaddress = $shipaddress;

        return $this;
    }

    public function getShiptel(): ?string
    {
        return $this->shiptel;
    }

    public function setShiptel(?string $shiptel): self
    {
        $this->shiptel = $shiptel;

        return $this;
    }

    public function getShipinf(): ?string
    {
        return $this->shipinf;
    }

    public function setShipinf(?string $shipinf): self
    {
        $this->shipinf = $shipinf;

        return $this;
    }

    public function getCreateat(): ?string
    {
        return $this->createat;
    }

    public function setCreateat(?string $createat): self
    {
        $this->createat = $createat;

        return $this;
    }

    public function getUpdateat(): ?string
    {
        return $this->updateat;
    }

    public function setUpdateat(?string $updateat): self
    {
        $this->updateat = $updateat;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
