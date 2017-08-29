<?php
use Doctrine\Common\Collections\ArrayCollection;

namespace KPM\Entities;

/**
 * @Entity @Table(name="user_group")
 */
class UserGroup
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
    protected $name;


    // ************************************************************
    // RELATIONSHIP

    /**
     * @OneToMany(targetEntity="User", mappedBy="userGroup")
     *
     * @var User[] An ArrayCollection of User objects.
     **/
    protected $users;
     
    public function addUser(User $user)
    {
        $this->users[] = $user;
    }

    /**
     * @OneToMany(targetEntity="GroupPermission", mappedBy="userGroup")
     *
     * @var GroupPermission[] An ArrayCollection of GroupPermission objects.
     **/
    protected $groupPermissions;
     
    public function addGroupPermission(GroupPermission $groupPermission)
    {
        $this->groupPermissions[] = $groupPermission;
    }
     
     
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->groupPermissions = new ArrayCollection();
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
}
