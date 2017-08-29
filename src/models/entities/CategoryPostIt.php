<?php
use Doctrine\Common\Collections\ArrayCollection;

namespace KPM\Entities;

/**
 * @Entity @Table(name="category_post_it")
 */
class CategoryPostIt
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
     * @Column(type="string", nullable=false, length=100)
     *
     * @var string
     */
    protected $name;

    
    // ************************************************************
    // RELATIONSHIP

    /**
     * @OneToMany(targetEntity="PostIt", mappedBy="category")
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
}
