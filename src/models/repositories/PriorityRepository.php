<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class PriorityRepository extends EntityRepository
{
    use TraitRepository;

    private $strFormat = "SELECT p %s FROM %s p %s %s";
    
    public function getPriorities($withPostIts = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN p.postIts pt" : "";

        $dql = sprintf($this->strFormat, $slcWPTs, PRIORITY_ENTITY_NAME, $joinWPTs, "ORDER BY p.name");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getPriorityById($id, $withPostIts = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN p.postIts pt" : "";

        $dql = sprintf($this->strFormat, $slcWPTs, PRIORITY_ENTITY_NAME, $joinWPTs, "WHERE p.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
