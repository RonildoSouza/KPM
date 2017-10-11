<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class PriorityRepository extends EntityRepository
{
    use TraitRepository;

    private $slcWPTs = "";
    private $joinWPTs = "";
    private $strFormat = "SELECT p %s FROM %s p %s %s";
    
    public function getPriorities($withPostIts = false)
    {
        $this->setJoins($withPostIts);

        $dql = sprintf($this->strFormat, $this->slcWPTs, PRIORITY_ENTITY_NAME, $this->joinWPTs, "ORDER BY p.name");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getPriorityById($id, $withPostIts = false)
    {
        $this->setJoins($withPostIts);

        $dql = sprintf($this->strFormat, $this->slcWPTs, PRIORITY_ENTITY_NAME, $this->joinWPTs, "WHERE p.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }

    private function setJoins($withPostIts)
    {
        $this->slcWPTs = $withPostIts ? ", pt" : "";
        $this->joinWPTs = $withPostIts ? " LEFT JOIN p.post_its pt" : "";
    }
}
