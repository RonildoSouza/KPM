<?php
namespace KPM\Entities;

/**
 * @Entity 
 * @Table(name="group_permission")
 */
class GroupPermission
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
     * @ManyToOne(targetEntity="Permission", inversedBy="group_permissions")
     * @JoinColumn(name="permission_id", referencedColumnName="id", nullable=false)
     *
     * @var KPM\Entities\Permission
     */
    protected $permission;

    /**
     * @ManyToOne(targetEntity="UserGroup", inversedBy="group_permissions")
     * @JoinColumn(name="user_group_id", referencedColumnName="id", nullable=false)
     *
     * @var KPM\Entities\UserGroup
     */
    protected $user_group;

    /**
     * @Column(type="boolean", nullable=false, options={"default":false})
     *
     * @var boolean
     */
    protected $is_allowed;


    // ************************************************************
    // GET and SET

    public function getId()
    {
        return $this->id;
    }

    public function getPermission()
    {
        return $this->permission;
    }

    public function setPermission(Permission $permission)
    {
        $permission->addGroupPermission($this);
        $this->permission = $permission;
    }
    
    public function getUserGroup()
    {
        return $this->user_group;
    }

    public function setUserGroup(UserGroup $user_group)
    {
        // $userGroup->addGroupPermission($this);
        $this->user_group = $user_group;
    }

    public function getIsAllowed()
    {
        return $this->is_allowed;
    }

    public function setIsAllowed($is_allowed)
    {
        $this->is_allowed = $is_allowed;
    }
}
