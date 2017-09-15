<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class StatusRepository extends EntityRepository
{
    use TraitRepository;

    private $slcWPTs = "";
    private $joinWPTs = "";
    private $strFormat = "SELECT s %s FROM %s s %s %s";
    
    public function getStatus($withPostIts = false)
    {
        $this->setJoins($withPostIts);

        $dql = sprintf($this->strFormat, $this->slcWPTs, STATUS_ENTITY_NAME, $this->joinWPTs, "ORDER BY s.name");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getStatusById($id, $withPostIts = false)
    {
        $this->setJoins($withPostIts);

        $dql = sprintf($this->strFormat, $this->slcWPTs, STATUS_ENTITY_NAME, $this->joinWPTs, "WHERE s.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }

    private function setJoins($withPostIts)
    {
        $this->slcWPTs = $withPostIts ? ", pt, up, partial u.{id, name}, pr, pj, c" : "";
        $this->joinWPTs = $withPostIts ? " LEFT JOIN s.postIts pt LEFT JOIN pt.userPostIts up"
        . " LEFT JOIN up.user u LEFT JOIN pt.priority pr"
        . " LEFT JOIN pt.project pj LEFT JOIN pt.category c" : "";
    }
}
