<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    use TraitRepository;

    private $strFormat = "SELECT c, p, partial u.{id, name} FROM %s c JOIN c.postIt p JOIN c.user u %s";
    
    public function getComments()
    {
        $dql = sprintf($this->strFormat, COMMENT_ENTITY_NAME, "ORDER BY c.id");

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getCommentById($id)
    {
        $dql = sprintf($this->strFormat, COMMENT_ENTITY_NAME, "WHERE c.id = ?1");

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
