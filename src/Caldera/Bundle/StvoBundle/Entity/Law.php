<?php

namespace Caldera\Bundle\StvoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="law")
 */
class Law
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

    public function __construct()
    {
        $this->paragraphs = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setSlug(string $slug): Law
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setTitle(string $title): Law
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
