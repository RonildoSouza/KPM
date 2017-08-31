<?php
namespace KPM\Repositories;

use \Doctrine\ORM\EntityRepository;
use \KPM\Entities\Comment;

class CommentRepository extends EntityRepository
{
    public function getComments()
    {
        $dql = "SELECT c, p, partial u.{id, name} FROM KPM\Entities\Comment c JOIN c.postIt p JOIN c.user u ORDER BY c.id";

        $query = $this->getEntityManager()
                      ->createQuery($dql);

        $comments = $query->getArrayResult();
        
        return $comments;
    }

    public function getCommentById($id)
    {
        $dql = "SELECT c, p, partial u.{id, name} FROM KPM\Entities\Comment c JOIN c.postIt p JOIN c.user u WHERE c.id = ?1";

        $query = $this->getEntityManager()
                      ->createQuery($dql)
                      ->setParameter(1, $id);        

        $comment = $query->getArrayResult();

        return $comment;
    }
}
