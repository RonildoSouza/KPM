<?php
namespace KPM\Entities;

/**
 * @Entity 
 * @Table(name="user_post_it")
 */
class UserPostIt
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
     * @ManyToOne(targetEntity="User", inversedBy="userPostIts")
     * @JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     *
     * @var KPM\Entities\User
     */
    protected $user;

    /**
     * @ManyToOne(targetEntity="PostIt", inversedBy="userPostIts")
     * @JoinColumn(name="postIt_id", referencedColumnName="id", nullable=false)
     *
     * @var KPM\Entities\PostIt
     */
    protected $postIt;

    /**
     * @Column(type="boolean", nullable=false, options={"default":false})
     *
     * @var boolean
     */
    protected $isOwner;


    // ************************************************************
    // GET and SET

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        // $user->addUserPostIt($this);
        $this->user = $user;
    }
    
    public function getPostIt()
    {
        return $this->postIt;
    }

    public function setPostIt(PostIt $postIt)
    {
        $postIt->addUserPostIt($this);
        $this->postIt = $postIt;
    }

    public function getIsOwner()
    {
        return $this->isOwner;
    }

    public function setIsOwner($isOwner)
    {
        $this->isOwner = $isOwner;
    }
}
