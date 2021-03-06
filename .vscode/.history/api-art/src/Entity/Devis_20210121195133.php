<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DevisRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=DevisRepository::class)
 */
class Devis
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *   @Groups("devis:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("devis:read")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=15)
     * @Groups("devis:read")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups("devis:read")
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("devis:read")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Groups("devis:read")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups("devis:read")
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("devis:read")
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("devis:read")
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("devis:read")
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("devis:read")
     */
    private $fileSecond;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(?string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getFileSecond(): ?string
    {
        return $this->fileSecond;
    }

    public function setFileSecond(?string $fileSecond): self
    {
        $this->fileSecond = $fileSecond;

        return $this;
    }
}
