<?php
use Doctrine\Common\Collections\ArrayCollection;

namespace KPM\Entities;

/**
 * @Entity 
 * @Table(name="post_it")
 */
class PostIt
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
    protected $title;

    /**
     * @Column(type="string", nullable=true, length=255, options={ "default":""})
     *
     * @var string
     */
    protected $summary;
    
    /**
     * @Column(type="integer", nullable=false, options={"unsigned":true, "default":0})
     *
     * @var int
     */
    protected $estimatedTime;


    // ************************************************************
    // RELATIONSHIP

    /**
     * @ManyToOne(targetEntity="Status", inversedBy="postIts")
     *
     * @var KPM\Entities\Status
     **/
    protected $status;
    
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus(Status $status)
    {
        $status->addPostIt($this);
        $this->status = $status;
    }

    /**
     * @ManyToOne(targetEntity="Priority", inversedBy="postIts")
     *
     * @var KPM\Entities\Priority
     **/
    protected $priority;
     
    public function getPriority()
    {
        return $this->priority;
    }
 
    public function setPriority(Priority $priority)
    {
        $priority->addPostIt($this);
        $this->priority = $priority;
    }

    /**
     * @ManyToOne(targetEntity="Project", inversedBy="postIts")
     *
     * @var KPM\Entities\Project
     **/
    protected $project;
     
    public function getProject()
    {
        return $this->project;
    }
 
    public function setProject(Project $project)
    {
        $project->addPostIt($this);
        $this->project = $project;
    }

    /**
     * @ManyToOne(targetEntity="CategoryPostIt", inversedBy="postIts")
     *
     * @var KPM\Entities\CategoryPostIt
     **/
    protected $category;
     
    public function getCategory()
    {
        return $this->category;
    }
 
    public function setCategory(Category $category)
    {
        $category->addPostIt($this);
        $this->category = $category;
    }

    /**
     * @OneToMany(targetEntity="UserPostIt", mappedBy="postIt")
     *
     * @var UserPostIt[] An ArrayCollection of UserPostIt objects.
     **/
    protected $userPostIts;
     
    public function addUserPostIt(UserPostIt $userPostIt)
    {
        $this->userPostIts[] = $userPostIt;
    }

    /**
     * @OneToMany(targetEntity="Comment", mappedBy="postIt")
     *
     * @var Comment[] An ArrayCollection of Comment objects.
     **/
    protected $comments;
     
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;
    }

    /**
     * @ManyToMany(targetEntity="PostIt")
     *
     * @var KPM\Entities\PostIt[]
     **/
    protected $postIts = null;
     
    public function linkPostIt(PostIt $postIt)
    {
        $this->postIts[] = $postIt;
    }
 
    public function getPostIts()
    {
        return $this->postIts;
    }
    

    public function __construct()
    {
        $this->userPostIts = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }


    // ************************************************************
    // GET and SET

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function setSummary($summary)
    {
        $this->summary = $summary;
    }    

    public function getEstimatedTime()
    {
        return $this->estimatedTime;
    }

    public function setEstimatedTime($estimatedTime)
    {
        $this->estimatedTime = $estimatedTime;
    }
}
