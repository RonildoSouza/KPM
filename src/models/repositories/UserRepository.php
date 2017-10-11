<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    use TraitRepository;

    private $slcWPTs = "";
    private $joinWPTs = "";
    private $slcCMTs = "";
    private $joinCMTs = "";
    private $strFormat = "SELECT u, ug %s %s FROM %s u LEFT JOIN u.user_group ug %s %s %s";
    
    public function getUsers($withPostIts = false, $withComments = false)
    {
        $this->setJoins($withPostIts, $withComments);
        
        $dql = sprintf($this->strFormat, $this->slcWPTs, $this->slcCMTs, USER_ENTITY_NAME, 
                        $this->joinWPTs, $this->joinCMTs, "ORDER BY u.name");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getUserById($id, $withPostIts = false, $withComments = false)
    {
        $this->setJoins($withPostIts, $withComments);

        $dql = sprintf($this->strFormat, $this->slcWPTs, $this->slcCMTs, USER_ENTITY_NAME, 
                        $this->joinWPTs, $this->joinCMTs, " WHERE u.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }

    private function setJoins($withPostIts, $withComments)
    {
        $this->slcWPTs = $withPostIts ? ", upt, pt" : "";
        $this->joinWPTs = $withPostIts ? " LEFT JOIN u.user_post_its upt LEFT JOIN upt.post_it pt" : "";

        $this->slcCMTs = $withComments ? ", c" : "";
        $this->joinCMTs = $withComments ? " LEFT JOIN u.comments c" : "";
    }
}
