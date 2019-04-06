<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $image;

    /**
     * @ORM\Column(type="bigint")
     */
    private $ISBN;

    /**
     * @ORM\Column(type="text")
     */
    private $summary;

    /**
     * @ORM\Column(type="float")
     */
    private $reservePrice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Genre", inversedBy="books")
     * @ORM\JoinColumn(nullable=true)
     */
    private $genre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bid", mappedBy="auctionItem")
     */
    private $bids;

    /**
     * @ORM\Column(type="float")
     */
    private $startingPrice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="books")
     */
    private $seller;

    public function __construct()
    {
        $this->bids = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getISBN(): ?int {
        return $this->ISBN;
    }

    public function setISBN(int $ISBN): self
    {
        $this->ISBN = $ISBN;
        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;
        return $this;
    }

    public function getReservePrice(): ?float
    {
        return $this->reservePrice;
    }

    public function setReservePrice(float $reservePrice): self
    {
        $this->reservePrice = $reservePrice;
        return $this;
    }

    // allow null
    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(Genre $genre = null)
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * @return Collection|Bid[]
     */
    public function getBids(): Collection
    {
        return $this->bids;
    }

    public function addBid(Bid $bid): self
    {
        if (!$this->bids->contains($bid)) {
            $this->bids[] = $bid;
            $bid->setAuctionItem($this);
        }

        return $this;
    }

    public function removeBid(Bid $bid): self
    {
        if ($this->bids->contains($bid)) {
            $this->bids->removeElement($bid);
            // set the owning side to null (unless already changed)
            if ($bid->getAuctionItem() === $this) {
                $bid->setAuctionItem(null);
            }
        }

        return $this;
    }

    public function getStartingPrice(): ?float
    {
        return $this->startingPrice;
    }

    public function setStartingPrice(float $startingPrice): self
    {
        $this->startingPrice = $startingPrice;

        return $this;
    }

    public function getSeller(): ?User
    {
        return $this->seller;
    }

    public function setSeller(?User $seller): self
    {
        $this->seller = $seller;

        return $this;
    }
}
