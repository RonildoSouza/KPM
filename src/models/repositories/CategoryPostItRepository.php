<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class CategoryPostItRepository extends EntityRepository
{
    use TraitRepository;

    private $strFormat = "SELECT c %s FROM %s c %s %s";

    public function getCategories($withPostIts = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN c.postIts pt" : "";
        
        $dql = sprintf($this->strFormat, $slcWPTs, CATEGORY_ENTITY_NAME, $joinWPTs, "ORDER BY c.name");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getCategoryById($id, $withPostIts = false)
    {
        $slcWPTs = $withPostIts ? ", pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN c.postIts pt" : "";

        $dql = sprintf($this->strFormat, $slcWPTs, CATEGORY_ENTITY_NAME, $joinWPTs, "WHERE c.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
