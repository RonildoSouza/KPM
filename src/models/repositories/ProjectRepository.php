<?php
namespace KPM\Repositories;

use \Doctrine\ORM\EntityRepository;
use \KPM\Entities\Project;

class ProjectRepository extends EntityRepository
{
    use TraitRepository;
    
    public function getProjects($withPostIts = false, $withCategories = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN p.postIts pt" : "";

        $slcCATs = $withCategories ? ", c" : "";
        $joinCATs = $withCategories ? " LEFT JOIN p.categories c" : "";
        
        $dql = "SELECT p" . $slcWPTs . $slcCATs . " FROM KPM\Entities\Project p"
        . $joinWPTs . $joinCATs . " ORDER BY p.name";

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getProjectById($id, $withPostIts = false, $withCategories = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN p.postIts pt" : "";

        $slcCATs = $withCategories ? ", c" : "";
        $joinCATs = $withCategories ? " LEFT JOIN p.categories c" : "";
        
        $dql = "SELECT p" . $slcWPTs . $slcCATs . " FROM KPM\Entities\Project p"
        . $joinWPTs . $joinCATs . " WHERE p.id = ?1";

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
