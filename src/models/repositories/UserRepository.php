<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    use TraitRepository;

    private $strFormat = "SELECT u, ug %s %s FROM %s u LEFT JOIN u.userGroup ug %s %s %s";
    
    public function getUsers($withPostIts = false, $withComments = false)
    {
        $slcWPTs = $withPostIts ? ", upt, pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN u.userPostIts upt LEFT JOIN upt.postIt pt" : "";

        $slcCMTs = $withComments ? ", c" : "";
        $joinCMTs = $withComments ? " LEFT JOIN u.comments c" : "";
        
        $dql = sprintf($this->strFormat, $slcWPTs, $slcCMTs, USER_ENTITY_NAME, $joinWPTs, $joinCMTs, "ORDER BY u.name");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getUserById($id, $withPostIts = false, $withComments = false)
    {
        $slcWPTs = $withPostIts ? ", upt, pt" : "";
        $joinWPTs = $withPostIts ? " LEFT JOIN u.userPostIts upt LEFT JOIN upt.postIt pt" : "";

        $slcCMTs = $withComments ? ", c" : "";
        $joinCMTs = $withComments ? " LEFT JOIN u.comments c" : "";

        $dql = sprintf($this->strFormat, $slcWPTs, $slcCMTs, USER_ENTITY_NAME, $joinWPTs, $joinCMTs, " WHERE u.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
