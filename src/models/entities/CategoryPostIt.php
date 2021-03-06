<?php
namespace KPM\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="KPM\Repositories\CategoryPostItRepository")
 * @Table(name="category_post_it")
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
