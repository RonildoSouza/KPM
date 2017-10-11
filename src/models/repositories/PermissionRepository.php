<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class PermissionRepository extends EntityRepository
{
    use TraitRepository;

    private $strFormat = "SELECT p, g, ug FROM %s p LEFT JOIN p.group_permissions g LEFT JOIN g.user_group ug %s";
    // private $strFormat = "SELECT p FROM %s p %s";

    public function getPermissions()
    {
        $dql = sprintf($this->strFormat, PERMISSION_ENTITY_NAME, "ORDER BY p.id");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getPermissionById($id)
    {
        $dql = sprintf($this->strFormat, PERMISSION_ENTITY_NAME, "WHERE p.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
