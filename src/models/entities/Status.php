<?php
namespace KPM\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="KPM\Repositories\StatusRepository")
 * @Table(name="status")
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
    protected $display_order;
    

    // ************************************************************
    // RELATIONSHIP

    /**
     * @OneToMany(targetEntity="PostIt", mappedBy="status")
     *
     * @var PostIt[] An ArrayCollection of PostIt objects.
     **/
    protected $post_its;

    public function addPostIt(PostIt $postIt)
    {
        $this->post_its[] = $postIt;
    }


    public function __construct()
    {
        $this->post_its = new ArrayCollection();
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
        return $this->display_order;
    }

    public function setDisplayOrder($display_order)
    {
        $this->display_order = $display_order;
    }
}
