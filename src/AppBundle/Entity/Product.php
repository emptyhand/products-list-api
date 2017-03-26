<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Product
 * @ExclusionPolicy("all")
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     *
     * @Expose
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Expose
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     * @Expose
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var bool
     *
     * @Expose
     * @ORM\Column(name="added", type="boolean")
     */
    private $added;

    /**
     * @Expose
     * @var ProductsList
     * @ORM\ManyToOne(targetEntity="ProductsList")
     */
    private $list;

    /**
     * @return ProductsList
     */
    public function getList(): ProductsList
    {
        return $this->list;
    }

    /**
     * @param ProductsList $list
     * @return $this
     */
    public function setList(ProductsList $list)
    {
        $this->list = $list;
        return $this;
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
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set added
     *
     * @param boolean $added
     *
     * @return Product
     */
    public function setAdded($added)
    {
        $this->added = $added;
        return $this;
    }

    /**
     * Get added
     *
     * @return bool
     */
    public function getAdded()
    {
        return $this->added;
    }
}

