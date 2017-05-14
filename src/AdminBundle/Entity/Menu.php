<?php

namespace AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\MenuRepository")
 */
class Menu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=255)
     */
    private $position;

    /**
     * @var int
     *
     * @ORM\Column(name="sortOrder", type="integer")
     */
    private $sortOrder;

    /**
     * @var Information
     *
     * @ORM\ManyToOne(targetEntity="Information", inversedBy="menu")
     * @ORM\JoinColumn(name="information_id")
     */
    private $information;

    public function __construct()
    {
        $this->information = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return Menu
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set sortOrder
     *
     * @param integer $sortOrder
     *
     * @return Menu
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * Get sortOrder
     *
     * @return int
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @return ArrayCollection
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param Information $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }
}

