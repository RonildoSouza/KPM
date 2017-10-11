<?php
namespace KPM\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="KPM\Repositories\PermissionRepository")
 * @Table(name="permission")
 */
class Permission
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
    protected $description;


    // ************************************************************
    // RELATIONSHIP

    /**
     * @OneToMany(targetEntity="GroupPermission", mappedBy="user_group", cascade={"persist", "remove", "refresh"})
     *
     * @var GroupPermission[] An ArrayCollection of GroupPermission objects.
     **/
    protected $group_permissions;
     
    public function addGroupPermission(GroupPermission $groupPermission)
    {
        $this->group_permissions[] = $groupPermission;
    }
     
     
    public function __construct()
    {
        $this->group_permissions = new ArrayCollection();
    }


    // ************************************************************
    // GET and SET

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
