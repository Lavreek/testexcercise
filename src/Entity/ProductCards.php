<?php

namespace App\Entity;

use App\Repository\ProductCardsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductCardsRepository::class)]
class ProductCards
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $header;

    #[ORM\Column(type: 'string', length: 255)]
    private $bodydescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeader(): ?string
    {
        return $this->header;
    }

    public function setHeader(string $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function getBodydescription(): ?string
    {
        return $this->bodydescription;
    }

    public function setBodydescription(string $bodydescription): self
    {
        $this->bodydescription = $bodydescription;

        return $this;
    }
}
