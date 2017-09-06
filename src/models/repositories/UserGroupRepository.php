<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class UserGroupRepository extends EntityRepository
{
    use TraitRepository;

    private $strFormat = "SELECT ug, gp, p %s FROM %s ug LEFT JOIN ug.groupPermissions gp LEFT JOIN gp.permission p %s %s";
    
    public function getUserGroups($withUsers = false)
    {
        $slcWURs = $withUsers ? ", partial u.{id, name}" : "";
        $joinWURs = $withUsers ? " LEFT JOIN ug.users u" : "";

        $dql = sprintf($this->strFormat, $slcWURs, USERGROUP_ENTITY_NAME, $joinWURs, "ORDER BY ug.name");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getUserGroupById($id, $withUsers = false)
    {
        $slcWURs = $withUsers ? ", partial u.{id, name}" : "";
        $joinWURs = $withUsers ? " LEFT JOIN ug.users u" : "";

        $dql = sprintf($this->strFormat, $slcWURs, USERGROUP_ENTITY_NAME, $joinWURs, "WHERE ug.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
