<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class StatusRepository extends EntityRepository
{
    use TraitRepository;
    
    public function getStatus($withPostIts = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN s.postIts pt" : "";
        
        $dql = "SELECT s" . $slcWPTs . " FROM " . STATUS_ENTITY_NAME . " s"
            . $joinWPTs . " ORDER BY s.name";

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getStatusById($id, $withPostIts = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN s.postIts pt" : "";
        
        $dql = "SELECT s" . $slcWPTs . " FROM " . STATUS_ENTITY_NAME . " s"
            . $joinWPTs . " WHERE s.id = ?1";

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
