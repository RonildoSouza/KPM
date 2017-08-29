<?php
use Doctrine\Common\Collections\ArrayCollection;

namespace KPM\Entities;

/**
 * @Entity @Table(name="user")
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
    protected $userPostIts;
     
    public function addUserPostIt(UserPostIt $userPostIt)
    {
        $this->userPostIts[] = $userPostIt;
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
     *
     * @var KPM\Entities\UserGroup
     **/
    protected $userGroup;
     
    public function getUserGroup()
    {
        return $this->userGroup;
    }
 
    public function setUserGroup(UserGroup $userGroup)
    {
        $userGroup->addUser($this);
        $this->userGroup = $userGroup;
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
