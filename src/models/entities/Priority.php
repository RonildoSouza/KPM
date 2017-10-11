<?php
namespace KPM\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="KPM\Repositories\PriorityRepository")
 * @Table(name="priority")
 */
class Priority
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
    
    
    // ************************************************************
    // RELATIONSHIP

    /**
     * @OneToMany(targetEntity="PostIt", mappedBy="priority")
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
}
