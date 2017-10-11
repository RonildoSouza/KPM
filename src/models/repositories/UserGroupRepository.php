<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class UserGroupRepository extends EntityRepository
{
    use TraitRepository;

    private $slcWURs = "";
    private $joinWURs = "";
    private $strFormat = "SELECT ug, gp, p %s FROM %s ug LEFT JOIN ug.group_permissions gp LEFT JOIN gp.permission p %s %s";
    
    public function getUserGroups($withUsers = false)
    {
        $this->setJoins($withUsers);

        $dql = sprintf($this->strFormat, $this->slcWURs, USERGROUP_ENTITY_NAME, $this->joinWURs, "ORDER BY ug.name");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getUserGroupById($id, $withUsers = false)
    {
        $this->setJoins($withUsers);

        $dql = sprintf($this->strFormat, $this->slcWURs, USERGROUP_ENTITY_NAME, $this->joinWURs, "WHERE ug.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }

    private function setJoins($withUsers)
    {
        $this->slcWURs = $withUsers ? ", partial u.{id, name}" : "";
        $this->joinWURs = $withUsers ? " LEFT JOIN ug.users u" : "";
    }
}
