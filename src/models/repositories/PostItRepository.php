<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class PostItRepository extends EntityRepository
{
    use TraitRepository;
    
    public function getPostIts($withComments = false)
    {
        $slcCMTs = $withComments ? ", cm, partial us.{id, name}" : "";
        $joinCMTs = $withComments ? " LEFT JOIN p.comments cm LEFT JOIN cm.user us" : "";

        $dql = "SELECT p, up, partial u.{id, name}, s, pr, pj, c" . $slcCMTs . " FROM " . POSTIT_ENTITY_NAME 
            . " p LEFT JOIN p.userPostIts up LEFT JOIN up.user u"
            . " LEFT JOIN p.status s LEFT JOIN p.priority pr"
            . " LEFT JOIN p.project pj LEFT JOIN p.category c"
            . $joinCMTs . " ORDER BY p.id";

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getPostItById($id, $withComments = false)
    {
        $slcCMTs = $withComments ? ", cm, partial us.{id, name}" : "";
        $joinCMTs = $withComments ? " LEFT JOIN p.comments cm LEFT JOIN cm.user us" : "";

        $dql = "SELECT p, up, partial u.{id, name}, s, pr, pj, c" . $slcCMTs . " FROM " . POSTIT_ENTITY_NAME 
            . " p LEFT JOIN p.userPostIts up LEFT JOIN up.user u"
            . " LEFT JOIN p.status s LEFT JOIN p.priority pr"
            . " LEFT JOIN p.project pj LEFT JOIN p.category c"
            . $joinCMTs . " WHERE p.id = ?1";

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
