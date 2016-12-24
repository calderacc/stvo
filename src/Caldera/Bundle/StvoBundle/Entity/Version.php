<?php

namespace Caldera\Bundle\StvoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Caldera\Bundle\StvoBundle\Repository\VersionRepository")
 * @ORM\Table(name="version")
 */
class Version
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Law", inversedBy="paragraphs")
     * @ORM\JoinColumn(name="law_id", referencedColumnName="id")
     */
    protected $law;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $validFrom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $validUntil;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    protected $bgblLink;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $draft;

    /**
     * @ORM\OneToMany(targetEntity="Paragraph", mappedBy="version")
     */
    protected $paragraphs;

    public function __construct()
    {
        $this->paragraphs = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setLaw(Law $law): Version
    {
        $this->law = $law;

        return $this;
    }

    public function getLaw(): ?Law
    {
        return $this->law;
    }

    public function setSlug(string $slug): Version
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setTitle(string $title): Version
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function addParagraph(Paragraph $paragraph): Version
    {
        $this->paragraphs->add($paragraph);

        return $this;
    }

    public function getParagraphs(): ArrayCollection
    {
        return $this->paragraphs;
    }

    public function setValidFrom(\DateTime $validFrom): Version
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    public function getValidFrom(): ?\DateTime
    {
        return $this->validFrom;
    }

    public function setValidUntil(\DateTime $validUntil): Version
    {
        $this->validUntil = $validUntil;

        return $this;
    }

    public function getValidUntil(): ?\DateTime
    {
        return $this->validUntil;
    }

    public function setBgblLink(string $bgblLink): Version
    {
        $this->bgblLink = $bgblLink;

        return $this;
    }

    public function getBgblLink(): ?string
    {
        return $this->bgblLink;
    }

    public function setDraft(bool $draft): Version
    {
        $this->draft = $draft;

        return $this;
    }

    public function getDraft(): ?\DateTime
    {
        return $this->draft;
    }
}
