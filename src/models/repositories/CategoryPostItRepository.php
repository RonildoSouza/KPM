<?php
namespace KPM\Repositories;

use \Doctrine\ORM\EntityRepository;
use \KPM\Entities\CategoryPostIt;

class CategoryPostItRepository extends EntityRepository
{
    use TraitRepository;

    public function getCategories($withPostIts = false)
    {
        $dql = "SELECT c FROM KPM\Entities\CategoryPostIt c ORDER BY c.name";
        
        if ($withPostIts) {
            $dql = "SELECT c, p FROM KPM\Entities\CategoryPostIt c LEFT JOIN c.postIts p ORDER BY c.name";
        }

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getCategoryById($id, $withPostIts = false)
    {
        $dql = "SELECT c FROM KPM\Entities\CategoryPostIt c WHERE c.id = ?1";

        if ($withPostIts) {
            $dql = "SELECT c, p FROM KPM\Entities\CategoryPostIt c LEFT JOIN c.postIts p WHERE c.id = ?1";
        }

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
