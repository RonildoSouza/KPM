<?php
namespace KPM\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="KPM\Repositories\UserGroupRepository")
 * @Table(name="user_group")
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
     * @OneToMany(targetEntity="User", mappedBy="user_group")
     *
     * @var User[] An ArrayCollection of User objects.
     **/
    protected $users;
     
    public function addUser(User $user)
    {
        $this->users[] = $user;
    }

    /**
     * @OneToMany(targetEntity="GroupPermission", mappedBy="user_group", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     *
     * @var GroupPermission[] An ArrayCollection of GroupPermission objects.
     **/
    protected $group_permissions = [];
     
    // public function addGroupPermission(GroupPermission $groupPermission)
    // {
    //     $this->group_permissions[] = $groupPermission;
    // }

    public function addGroupPermission(Permission $permission, $isAllowed)
    {
        $groupPermission = new \KPM\Entities\GroupPermission();
        $groupPermission->setPermission($permission);
        $groupPermission->setIsAllowed($isAllowed);
        $groupPermission->setUserGroup($this);

        $this->group_permissions->add($groupPermission);
    }

    public function getGroupPermissions()
    {
        return $this->group_permissions;
    }

     
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->group_permissions = new ArrayCollection();
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
