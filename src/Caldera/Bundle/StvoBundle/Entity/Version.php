<?php

namespace Caldera\Bundle\StvoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
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
     * @ORM\Column(type="string", length=255)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\OneToMany(targetEntity="Paragraph", mappedBy="version")
     */
    protected paragraphs;

    public function __construct()
    {
        $this->paragraphs = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
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
}
