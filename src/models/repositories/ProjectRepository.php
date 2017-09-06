<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository
{
    use TraitRepository;

    private $strFormat = "SELECT p %s %s FROM %s p %s %s %s";
    
    public function getProjects($withPostIts = false, $withCategories = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN p.postIts pt" : "";

        $slcCATs = $withCategories ? ", c" : "";
        $joinCATs = $withCategories ? " LEFT JOIN p.categories c" : "";

        $dql = sprintf($this->strFormat, $slcWPTs, $slcCATs, PROJECT_ENTITY_NAME, $joinWPTs, $joinCATs, "ORDER BY p.name");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getProjectById($id, $withPostIts = false, $withCategories = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN p.postIts pt" : "";

        $slcCATs = $withCategories ? ", c" : "";
        $joinCATs = $withCategories ? " LEFT JOIN p.categories c" : "";

        $dql = sprintf($this->strFormat, $slcWPTs, $slcCATs, PROJECT_ENTITY_NAME, $joinWPTs, $joinCATs, "WHERE p.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
