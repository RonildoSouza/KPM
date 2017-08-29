<?php
use Doctrine\Common\Collections\ArrayCollection;

namespace KPM\Entities;

/**
 * @Entity @Table(name="project")
 */
class Project
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
     * @Column(type="string", nullable=false, length=4)
     *
     * @var string
     */
    protected $acronym;

    /**
     * @Column(type="string", nullable=false, length=255)
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
     * @Column(type="datetime", nullable=false)
     *
     * @var DateTime
     */
    protected $startDate;

    /**
     * @Column(type="datetime", nullable=false)
     *
     * @var DateTime
     */
    protected $endDate;
    
    
    // ************************************************************
    // RELATIONSHIP

    /**
     * @OneToMany(targetEntity="PostIt", mappedBy="project")
     *
     * @var PostIt[] An ArrayCollection of PostIt objects.
     **/
    protected $postIts;
         
    public function addPostIt(PostIt $postIt)
    {
        $this->postIts[] = $postIt;
    }

    /**
     * @ManyToMany(targetEntity="CategoryPostIt")
     *
     * @var KPM\Entities\CategoryPostIt[]
     **/
    protected $categories = null;
     
    public function addCategory(CategoryPostIt $category)
    {
        $this->categories[] = $category;
    }
 
    public function getCategories()
    {
        return $this->categories;
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

    public function getAcronym()
    {
        return $this->acronym;
    }

    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;
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

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }
}
