<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class PermissionRepository extends EntityRepository
{    
    use TraitRepository;

    public function getPermissions()
    {
        // $dql = "SELECT p, g FROM " . PERMISSION_ENTITY_NAME . " p LEFT JOIN p.groupPermissions g ORDER BY p.id";
        $dql = "SELECT p FROM " . PERMISSION_ENTITY_NAME . " p ORDER BY p.id";

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getPermissionById($id)
    {
        // $dql = "SELECT p, g FROM " . PERMISSION_ENTITY_NAME . " p LEFT JOIN p.groupPermissions g WHERE p.id = ?1";
        $dql = "SELECT p FROM " . PERMISSION_ENTITY_NAME . " p WHERE p.id = ?1";

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
