<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository
{
    use TraitRepository;

    private $slcWPTs = "";
    private $joinWPTs = "";
    private $slcCATs = "";
    private $joinCATs = "";
    private $strFormat = "SELECT p %s %s FROM %s p %s %s %s";
    
    public function getProjects($withPostIts = false, $withCategories = false)
    {
        $this->setJoins($withPostIts, $withCategories);

        $dql = sprintf($this->strFormat, $this->slcWPTs, $this->slcCATs, PROJECT_ENTITY_NAME, 
                        $this->joinWPTs, $this->joinCATs, "ORDER BY p.name");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getProjectById($id, $withPostIts = false, $withCategories = false)
    {
        $this->setJoins($withPostIts, $withCategories);

        $dql = sprintf($this->strFormat, $this->slcWPTs, $this->slcCATs, PROJECT_ENTITY_NAME, 
                        $this->joinWPTs, $this->joinCATs, "WHERE p.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }

    private function setJoins($withPostIts, $withCategories)
    {
        $this->slcWPTs = $withPostIts ? ", pt" : "";
        $this->joinWPTs = $withPostIts ? " LEFT JOIN p.post_its pt" : "";

        $this->slcCATs = $withCategories ? ", c" : "";
        $this->joinCATs = $withCategories ? " LEFT JOIN p.categories c" : "";
    }
}
