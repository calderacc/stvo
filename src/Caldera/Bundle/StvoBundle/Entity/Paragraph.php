<?php

namespace Caldera\Bundle\StvoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="paragraph")
 */
class Paragraph
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Version", inversedBy="paragraphs")
     * @ORM\JoinColumn(name="version_id", referencedColumnName="id")
     */
    protected $version;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $text;

    public function __construct()
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setVersion(Version $version): Paragraph
    {
        $this->version = $version;

        return $this;
    }

    public function getVersion(): ?Version
    {
        return $this->version;
    }

    public function setNumber(string $number): Paragraph
    {
        $this->number = $number;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setTitle(string $title): Paragraph
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setText(string $text): Paragraph
    {
        $this->text = $text;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }
}
