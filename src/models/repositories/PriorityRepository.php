<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class PriorityRepository extends EntityRepository
{
    use TraitRepository;
    
    public function getPriorities($withPostIts = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN p.postIts pt" : "";
        
        $dql = "SELECT p" . $slcWPTs . " FROM " . PRIORITY_ENTITY_NAME . " p"
            . $joinWPTs . " ORDER BY p.name";

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getPriorityById($id, $withPostIts = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN p.postIts pt" : "";
        
        $dql = "SELECT p" . $slcWPTs . " FROM " . PRIORITY_ENTITY_NAME . " p"
            . $joinWPTs . " WHERE p.id = ?1";

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
