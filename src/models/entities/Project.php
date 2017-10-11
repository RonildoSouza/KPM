<?php
namespace KPM\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="KPM\Repositories\ProjectRepository")
 * @Table(name="project")
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
    protected $start_date;

    /**
     * @Column(type="datetime", nullable=false)
     *
     * @var DateTime
     */
    protected $end_date;

    /**
     * @Column(type="integer", nullable=false, options={"unsigned":true, "default":10})
     *
     * @var int
     */
    protected $status;
    
    
    // ************************************************************
    // RELATIONSHIP

    /**
     * @OneToMany(targetEntity="PostIt", mappedBy="project")
     *
     * @var PostIt[] An ArrayCollection of PostIt objects.
     **/
    protected $post_its;
         
    public function addPostIt(PostIt $postIt)
    {
        $this->post_its[] = $postIt;
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
        $this->post_its = new ArrayCollection();
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
        return $this->start_date;
    }

    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    public function getEndDate()
    {
        return $this->end_date;
    }

    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}
