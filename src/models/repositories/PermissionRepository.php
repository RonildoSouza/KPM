<?php
namespace KPM\Repositories;

use \Doctrine\ORM\EntityRepository;
use \KPM\Entities\Permission;

class PermissionRepository extends EntityRepository
{    
    use TraitRepository;

    public function getPermissions()
    {
        // $dql = "SELECT p, g FROM KPM\Entities\Permission p LEFT JOIN p.groupPermissions g ORDER BY p.id";
        $dql = "SELECT p FROM KPM\Entities\Permission p ORDER BY p.id";

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getPermissionById($id)
    {
        // $dql = "SELECT p, g FROM KPM\Entities\Permission p LEFT JOIN p.groupPermissions g WHERE p.id = ?1";
        $dql = "SELECT p FROM KPM\Entities\Permission p WHERE p.id = ?1";

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
