<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class CategoryPostItRepository extends EntityRepository
{
    use TraitRepository;

    private $slcWPTs = "";
    private $joinWPTs = "";
    private $strFormat = "SELECT c %s FROM %s c %s %s";

    public function getCategories($withPostIts = false)
    {
        $this->setJoins($withPostIts);
        
        $dql = sprintf($this->strFormat, $this->slcWPTs, CATEGORY_ENTITY_NAME, $this->joinWPTs, "ORDER BY c.name");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getCategoryById($id, $withPostIts = false)
    {
        $this->setJoins($withPostIts);

        $dql = sprintf($this->strFormat, $this->slcWPTs, CATEGORY_ENTITY_NAME, $this->joinWPTs, "WHERE c.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }

    private function setJoins($withPostIts)
    {
        $this->slcWPTs = $withPostIts ? ", pt" : "";
        $this->joinWPTs = $withPostIts ? " LEFT JOIN c.postIts pt" : "";
    }
}
