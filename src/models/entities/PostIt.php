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
    protected $estimated_time;

    /**
     * @Column(type="datetime", nullable=false)
     *
     * @var DateTime
     */
    protected $created_at;
    
    /**
     * @Column(type="datetime", nullable=true)
     *
     * @var DateTime
     */
    protected $updated_at;


    // ************************************************************
    // RELATIONSHIP

    /**
     * @ManyToOne(targetEntity="Status", inversedBy="post_its")
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
     * @ManyToOne(targetEntity="Priority", inversedBy="post_its")
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
     * @ManyToOne(targetEntity="Project", inversedBy="post_its")
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
     * @ManyToOne(targetEntity="CategoryPostIt", inversedBy="post_its")
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
     * @OneToMany(targetEntity="UserPostIt", mappedBy="post_it", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     *
     * @var UserPostIt[] An ArrayCollection of UserPostIt objects.
     **/
    protected $user_post_its = [];
     
    public function addUserPostIt(UserPostIt $userPostIt)
    {
        $this->user_post_its[] = $userPostIt;
    }

    public function setUserPostIt(User $user, $isOwner = false)
    {
        foreach ($this->user_post_its as $up) {
            if ($up->getUser()->getId() === $user->getId()) {
                return;
            }
        }

        $userPostIt = new \KPM\Entities\UserPostIt();
        $userPostIt->setUser($user);
        $userPostIt->setIsOwner($isOwner);
        $userPostIt->setPostIt($this);

        $this->user_post_its->add($userPostIt);
    }

    public function removeUserPostIt(User $user)
    {
        foreach ($this->user_post_its as $up) {
            if ($up->getUser()->getId() === $user->getId() && !$up->getIsOwner()) {
                $this->user_post_its->removeElement($up);
            }
        }
    }

    // public function getuser_post_its()
    // {
    //     return $this->user_post_its;
    // }

    /**
     * @OneToMany(targetEntity="Comment", mappedBy="post_it")
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
    protected $post_its = null;
     
    public function linkPostIt(PostIt $postIt)
    {
        $this->post_its[] = $postIt;
    }
 
    public function getPostIts()
    {
        return $this->post_its;
    }
    

    public function __construct()
    {
        $this->user_post_its = new ArrayCollection();
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
        return $this->estimated_time;
    }

    public function setEstimatedTime($estimated_time)
    {
        $this->estimated_time = $estimated_time;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }
}
