<?php

namespace Fuz\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FiddleConfig
 *
 * @ORM\Table(name="fiddle_config")
 * @ORM\Entity
 */
class FiddleConfig
{

    /**
     * @var Fiddle
     *
     * @ORM\OneToOne(targetEntity="Fiddle")
     * @ORM\JoinColumn(name="fiddle_id", referencedColumnName="id", onDelete="cascade")
     * @ORM\Id
     */
    private $fiddle;

    /**
     * @var string
     *
     * @ORM\Column(name="twig_version", type="string", length=32)
     */
    private $twigVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=64, nullable=true)
     */
    private $tags;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_private", type="boolean")
     */
    private $isPrivate = false;

    /**
     * Set fiddle
     *
     * @param Fiddle $fiddle
     * @return FiddleTemplate
     */
    public function setFiddle(Fiddle $fiddle)
    {
        $this->fiddle = $fiddle;

        return $this;
    }

    /**
     * Get fiddle
     *
     * @return Fiddle
     */
    public function getFiddle()
    {
        return $this->fiddle;
    }

    /**
     * Set twigVersion
     *
     * @param string $twigVersion
     * @return FiddleConfig
     */
    public function setTwigVersion($twigVersion)
    {
        $this->twigVersion = $twigVersion;

        return $this;
    }

    /**
     * Get twigVersion
     *
     * @return string
     */
    public function getTwigVersion()
    {
        return $this->twigVersion;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return FiddleConfig
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return FiddleConfig
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set isPrivate
     *
     * @param boolean $isPrivate
     * @return FiddleConfig
     */
    public function setIsPrivate($isPrivate)
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    /**
     * Get isPrivate
     *
     * @return boolean
     */
    public function getIsPrivate()
    {
        return $this->isPrivate;
    }

}
