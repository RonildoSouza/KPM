<?php
namespace KPM\Repositories;

use \Doctrine\ORM\EntityRepository;
use \KPM\Entities\Priority;

class PriorityRepository extends EntityRepository
{
    use TraitRepository;
    
    public function getPriorities($withPostIts = false)
    {
        $dql = "SELECT p FROM KPM\Entities\Priority p ORDER BY p.name";

        if ($withPostIts) {
            $dql = "SELECT p, pt FROM KPM\Entities\Priority p LEFT JOIN p.postIts pt ORDER BY p.name";
        }

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getPriorityById($id, $withPostIts = false)
    {
        $dql = "SELECT p FROM KPM\Entities\Priority p WHERE p.id = ?1";

        if ($withPostIts) {
            $dql = "SELECT p, pt FROM KPM\Entities\Priority p LEFT JOIN p.postIts pt WHERE p.id = ?1";
        }

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
