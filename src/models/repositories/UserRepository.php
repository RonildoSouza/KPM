<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    use TraitRepository;
    
    public function getUsers($withPostIts = false, $withComments = false)
    {
        $slcWPTs = $withPostIts ? ", upt, pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN u.userPostIts upt JOIN upt.postIt pt" : "";

        $slcCMTs = $withComments ? ", c" : "";
        $joinCMTs = $withComments ? " LEFT JOIN u.comments c" : "";
        
        $dql = "SELECT u, ug" . $slcWPTs . $slcCMTs . " FROM " . USER_ENTITY_NAME
            . " u LEFT JOIN u.userGroup ug " . $joinWPTs . $joinCMTs . " ORDER BY u.name";

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getUserById($id, $withPostIts = false, $withComments = false)
    {
        $slcWPTs = $withPostIts ? ", upt, pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN u.userPostIts upt JOIN upt.postIt pt" : "";

        $slcCMTs = $withComments ? ", c" : "";
        $joinCMTs = $withComments ? " LEFT JOIN u.comments c" : "";

        $dql = "SELECT u, ug" . $slcWPTs . $slcCMTs . " FROM " . USER_ENTITY_NAME
            . " u LEFT JOIN u.userGroup ug " . $joinWPTs . $joinCMTs . " WHERE u.id = ?1";

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
