<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class UserGroupRepository extends EntityRepository
{
    use TraitRepository;
    
    public function getUserGroups($withUsers = false)
    {
        $slcWURs = $withUsers ? ", u" : "";
        $joinWURs = $withUsers ? " LEFT JOIN ug.users u" : "";
        
        $dql = "SELECT ug, gp, p" . $slcWURs . " FROM " . USERGROUP_ENTITY_NAME
            . " ug LEFT JOIN ug.groupPermissions gp LEFT JOIN gp.permission p " . $joinWURs . " ORDER BY ug.name";

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getUserGroupById($id, $withUsers = false)
    {
        $slcWURs = $withUsers ? ", u" : "";
        $joinWURs = $withUsers ? " LEFT JOIN ug.users u" : "";

        $dql = "SELECT ug, gp, p" . $slcWURs . " FROM " . USERGROUP_ENTITY_NAME
            . " ug LEFT JOIN ug.groupPermissions gp LEFT JOIN gp.permission p " . $joinWURs . " WHERE ug.id = ?1";

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
