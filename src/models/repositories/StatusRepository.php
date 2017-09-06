<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class StatusRepository extends EntityRepository
{
    use TraitRepository;

    private $strFormat = "SELECT s %s FROM %s s %s %s";
    
    public function getStatus($withPostIts = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN s.postIts pt" : "";

        $dql = sprintf($this->strFormat, $slcWPTs, STATUS_ENTITY_NAME, $joinWPTs, "ORDER BY s.name");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getStatusById($id, $withPostIts = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN s.postIts pt" : "";

        $dql = sprintf($this->strFormat, $slcWPTs, STATUS_ENTITY_NAME, $joinWPTs, "WHERE s.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
