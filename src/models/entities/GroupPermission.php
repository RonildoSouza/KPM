<?php

namespace KPM\Entities;

/**
 * @Entity @Table(name="group_permission")
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
     * @ManyToOne(targetEntity="Permission", inversedBy="groupPermissions")
     *
     * @var KPM\Entities\Permission
     */
    protected $permission;

    /**
     * @ManyToOne(targetEntity="UserGroup", inversedBy="groupPermissions")
     *
     * @var KPM\Entities\UserGroup
     */
    protected $userGroup;

    /**
     * @Column(type="boolean", nullable=false, options={"default":false})
     *
     * @var boolean
     */
    protected $isAllowed;


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
        return $this->userGroup;
    }

    public function setUserGroup(UserGroup $userGroup)
    {
        $userGroup->addGroupPermission($this);
        $this->userGroup = $userGroup;
    }

    public function getIsAllowed()
    {
        return $this->isAllowed;
    }

    public function setIsAllowed($isAllowed)
    {
        $this->isAllowed = $isAllowed;
    }
}
