<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class CategoryPostItRepository extends EntityRepository
{
    use TraitRepository;

    public function getCategories($withPostIts = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN c.postIts pt" : "";
        
        $dql = "SELECT c" . $slcWPTs . " FROM " . CATEGORY_ENTITY_NAME . " c"
            . $joinWPTs . " ORDER BY c.name";

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getCategoryById($id, $withPostIts = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN c.postIts pt" : "";
        
        $dql = "SELECT c" . $slcWPTs . " FROM " . CATEGORY_ENTITY_NAME . " c"
            . $joinWPTs . " WHERE c.id = ?1";

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
