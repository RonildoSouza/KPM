<?php
namespace KPM\Repositories;

use \Doctrine\ORM\EntityRepository;
use \KPM\Entities\Permission;

class PermissionRepository extends EntityRepository
{
    public function getPermissions()
    {
        // $dql = "SELECT p, g FROM KPM\Entities\Permission p LEFT JOIN p.groupPermissions g ORDER BY p.id";
        $dql = "SELECT p FROM KPM\Entities\Permission p ORDER BY p.id";

        $query = $this->getEntityManager()
                      ->createQuery($dql);

        $permissions = $query->getArrayResult();
        
        return $permissions;
    }

    public function getPermissionById($id)
    {
        // $dql = "SELECT p, g FROM KPM\Entities\Permission p LEFT JOIN p.groupPermissions g WHERE p.id = ?1";
        $dql = "SELECT p FROM KPM\Entities\Permission p WHERE p.id = ?1";

        $query = $this->getEntityManager()
                      ->createQuery($dql)
                      ->setParameter(1, $id);        

        $permission = $query->getArrayResult();

        return $permission;
    }
}
