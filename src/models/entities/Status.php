<?php
use Doctrine\Common\Collections\ArrayCollection;

namespace KPM\Entities;

/**
 * @Entity @Table(name="status")
 */
class Status
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string", nullable=false, length=100)
     *
     * @var string
     */
    protected $name;

    /**
     * @Column(type="string", nullable=false, length=100)
     *
     * @var string
     */
    protected $color;

    /**
     * @Column(type="string", nullable=false, length=100)
     *
     * @var string
     */
    protected $icon;

    /**
     * @Column(type="integer", nullable=false, options={"unsigned":true})
     *
     * @var int
     */
    protected $displayOrder;
    

    // ************************************************************
    // RELATIONSHIP

    /**
     * @OneToMany(targetEntity="PostIt", mappedBy="status")
     *
     * @var PostIt[] An ArrayCollection of PostIt objects.
     **/
    protected $postIts;

    public function addPostIt(PostIt $postIt)
    {
        $this->postIts[] = $postIt;
    }


    public function __construct()
    {
        $this->postIts = new ArrayCollection();
    }
    

    // ************************************************************
    // GET and SET

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    public function setDisplayOrder($displayOrder)
    {
        $this->displayOrder = $displayOrder;
    }
}
