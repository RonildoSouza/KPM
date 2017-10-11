<?php
namespace KPM\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="KPM\Repositories\UserRepository")
 * @Table(name="user")
 */
class User
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
    protected $login;

    /**
     * @Column(type="string", nullable=false, length=255)
     *
     * @var string
     */
    protected $password;


    // ************************************************************
    // RELATIONSHIP

    /**
     * @OneToMany(targetEntity="UserPostIt", mappedBy="user")
     *
     * @var UserPostIt[] An ArrayCollection of UserPostIt objects.
     **/
    protected $user_post_its;
     
    public function addUserPostIt(UserPostIt $userPostIt)
    {
        $this->user_post_its[] = $userPostIt;
    }

    /**
     * @OneToMany(targetEntity="Comment", mappedBy="user")
     *
     * @var Comment[] An ArrayCollection of Comment objects.
     **/
    protected $comments;
     
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;
    }

    /**
     * @ManyToOne(targetEntity="UserGroup", inversedBy="users")
     * @JoinColumn(name="user_group_id", referencedColumnName="id", nullable=false)
     *
     * @var KPM\Entities\UserGroup
     **/
    protected $user_group;
     
    public function getUserGroup()
    {
        return $this->user_group;
    }
 
    public function setUserGroup(UserGroup $user_group)
    {
        $user_group->addUser($this);
        $this->user_group = $user_group;
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}
