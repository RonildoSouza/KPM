<?php
namespace KPM\Repositories;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    use TraitRepository;
    
    public function getComments()
    {
        $dql = "SELECT c, p, partial u.{id, name} FROM " . COMMENT_ENTITY_NAME . " c JOIN c.postIt p JOIN c.user u ORDER BY c.id";

        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getCommentById($id)
    {
        $dql = "SELECT c, p, partial u.{id, name} FROM " . COMMENT_ENTITY_NAME . " c JOIN c.postIt p JOIN c.user u WHERE c.id = ?1";

        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
