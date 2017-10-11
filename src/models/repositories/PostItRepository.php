<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class PostItRepository extends EntityRepository
{
    use TraitRepository;

    private $slcCMTs = "";
    private $joinCMTs = "";
    private $strFormat = "SELECT p, up, partial u.{id, name}, s, pr, pj, c %s FROM %s"
    . " p LEFT JOIN p.user_post_its up LEFT JOIN up.user u"
    . " LEFT JOIN p.status s LEFT JOIN p.priority pr"
    . " LEFT JOIN p.project pj LEFT JOIN p.category c"
    . " %s %s";
    
    public function getPostIts($withComments = false)
    {
        $this->setJoins($withComments);

        $dql = sprintf($this->strFormat, $this->slcCMTs, POSTIT_ENTITY_NAME, $this->joinCMTs, "ORDER BY p.id");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getPostItById($id, $withComments = false)
    {
        $this->setJoins($withComments);
        
        $dql = sprintf($this->strFormat, $this->slcCMTs, POSTIT_ENTITY_NAME, $this->joinCMTs, "WHERE p.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }

    private function setJoins($withComments)
    {
        $this->slcCMTs = $withComments ? ", cm, partial us.{id, name}" : "";
        $this->joinCMTs = $withComments ? " LEFT JOIN p.comments cm LEFT JOIN cm.user us" : "";
    }
}
