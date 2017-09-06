<?php
namespace KPM\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="KPM\Repositories\PostItRepository")
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

    /**
     * @Column(type="datetime", nullable=false)
     *
     * @var DateTime
     */
    protected $createdAt;
    
    /**
     * @Column(type="datetime", nullable=true)
     *
     * @var DateTime
     */
    protected $updatedAt;


    // ************************************************************
    // RELATIONSHIP

    /**
     * @ManyToOne(targetEntity="Status", inversedBy="postIts")
     * @JoinColumn(name="status_id", referencedColumnName="id", nullable=false)
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
     * @JoinColumn(name="priority_id", referencedColumnName="id", nullable=false)
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
     * @JoinColumn(name="project_id", referencedColumnName="id", nullable=false)
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
     * @JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     *
     * @var KPM\Entities\CategoryPostIt
     **/
    protected $category;
     
    public function getCategory()
    {
        return $this->category;
    }
 
    public function setCategory(CategoryPostIt $category)
    {
        $category->addPostIt($this);
        $this->category = $category;
    }

    /**
     * @OneToMany(targetEntity="UserPostIt", mappedBy="postIt", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     *
     * @var UserPostIt[] An ArrayCollection of UserPostIt objects.
     **/
    protected $userPostIts = [];
     
    public function addUserPostIt(UserPostIt $userPostIt)
    {
        $this->userPostIts[] = $userPostIt;
    }

    public function setUserPostIt(User $user, $isOwner = false)
    {
        foreach ($this->userPostIts as $up) {
            if ($up->getUser()->getId() === $user->getId()) {
                return;
            }
        }

        $userPostIt = new \KPM\Entities\UserPostIt();
        $userPostIt->setUser($user);
        $userPostIt->setIsOwner($isOwner);
        $userPostIt->setPostIt($this);

        $this->userPostIts->add($userPostIt);
    }

    public function removeUserPostIt(User $user)
    {
        foreach ($this->userPostIts as $up) {
            if ($up->getUser()->getId() === $user->getId() && !$up->getIsOwner()) {
                $this->userPostIts->removeElement($up);
            }
        }
    }

    // public function getUserPostIts()
    // {
    //     return $this->userPostIts;
    // }

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

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}
