<?php
namespace KPM\Repositories;

use \Doctrine\ORM\EntityRepository;
use \KPM\Entities\CategoryPostIt;

class CategoryPostItRepository extends EntityRepository
{
    public function getCategories($withPostIts = false)
    {
        $dql = "SELECT c FROM KPM\Entities\CategoryPostIt c ORDER BY c.name";
        
        if ($withPostIts) {
            $dql = "SELECT c, p FROM KPM\Entities\CategoryPostIt c LEFT JOIN c.postIts p ORDER BY c.name";
        }

        $query = $this->getEntityManager()
                      ->createQuery($dql);

        $categories = $query->getArrayResult();
        
        return $categories;
    }

    public function getCategoryById($id, $withPostIts = false)
    {
        $dql = "SELECT c FROM KPM\Entities\CategoryPostIt c WHERE c.id = ?1";

        if ($withPostIts) {
            $dql = "SELECT c, p FROM KPM\Entities\CategoryPostIt c LEFT JOIN c.postIts p WHERE c.id = ?1";
        }

        $query = $this->getEntityManager()
                      ->createQuery($dql)
                      ->setParameter(1, $id);        

        $category = $query->getArrayResult();

        // var_dump($query);

        return $category;
    }
}
