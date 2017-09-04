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
     * @OneToMany(targetEntity="GroupPermission", mappedBy="userGroup", cascade={"persist"})
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
        $this->groupPermissions = new ArrayCollection();
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
