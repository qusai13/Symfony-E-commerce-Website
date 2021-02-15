<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SettingsRepository")
 */
class Settings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $keywords;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $smtpserver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $smtpmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $smtppasw;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $smtpport;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $aboutus;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contact;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $referans;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $createdat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $updatedat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSmtpserver(): ?string
    {
        return $this->smtpserver;
    }

    public function setSmtpserver(?string $smtpserver): self
    {
        $this->smtpserver = $smtpserver;

        return $this;
    }

    public function getSmtpmail(): ?string
    {
        return $this->smtpmail;
    }

    public function setSmtpmail(?string $smtpmail): self
    {
        $this->smtpmail = $smtpmail;

        return $this;
    }

    public function getSmtppasw(): ?string
    {
        return $this->smtppasw;
    }

    public function setSmtppasw(?string $smtppasw): self
    {
        $this->smtppasw = $smtppasw;

        return $this;
    }

    public function getSmtpport(): ?string
    {
        return $this->smtpport;
    }

    public function setSmtpport(?string $smtpport): self
    {
        $this->smtpport = $smtpport;

        return $this;
    }

    public function getAboutus(): ?string
    {
        return $this->aboutus;
    }

    public function setAboutus(?string $aboutus): self
    {
        $this->aboutus = $aboutus;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getReferans(): ?string
    {
        return $this->referans;
    }

    public function setReferans(?string $referans): self
    {
        $this->referans = $referans;

        return $this;
    }

    public function getCreatedat(): ?string
    {
        return $this->createdat;
    }

    public function setCreatedat(?string $createdat): self
    {
        $this->createdat = $createdat;

        return $this;
    }

    public function getUpdatedat(): ?string
    {
        return $this->updatedat;
    }

    public function setUpdatedat(?string $updatedat): self
    {
        $this->updatedat = $updatedat;

        return $this;
    }
}
