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
     * @ManyToOne(targetEntity="User", inversedBy="user_post_its")
     * @JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     *
     * @var KPM\Entities\User
     */
    protected $user;

    /**
     * @ManyToOne(targetEntity="PostIt", inversedBy="user_post_its")
     * @JoinColumn(name="post_it_id", referencedColumnName="id", nullable=false)
     *
     * @var KPM\Entities\PostIt
     */
    protected $post_it;

    /**
     * @Column(type="boolean", nullable=false, options={"default":false})
     *
     * @var boolean
     */
    protected $is_owner;


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
        return $this->post_it;
    }

    public function setPostIt(PostIt $post_it)
    {
        $post_it->addUserPostIt($this);
        $this->post_it = $post_it;
    }

    public function getIsOwner()
    {
        return $this->is_owner;
    }

    public function setIsOwner($is_owner)
    {
        $this->is_owner = $is_owner;
    }
}
