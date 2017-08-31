<?php
namespace KPM\Actions;

use \Doctrine\ORM\EntityManager;
use \KPM\Actions\AbstractAction;

class CommentAction extends AbstractAction
{
    private $commentRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->commentRepository = $this->entityManager->getRepository('KPM\Entities\Comment');
    }

    public function get($aQSP = [], $id = 0)
    {
        if ($id === 0) {
            $comments = $this->commentRepository->getComments();
            return $comments;
        } else {
            $comment = $this->commentRepository->getCommentById($id);
            return $comment;
        }
    }
    
    public function postOrPut($jsonObj, $id = 0)
    {
        $comment = new \KPM\Entities\Comment();

        if ($id !== 0) {
            $comment = $this->entityManager->find('KPM\Entities\Comment', $id);
            $comment->setUpdatedAt(new \DateTime('now'));
        } else {
            $comment->setCreatedAt(new \DateTime('now'));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (array_key_exists('user_id', $jsonObj)) {
                $user = $this->entityManager->find('KPM\Entities\User', (int)$jsonObj['user_id']);
                $comment->setUser($user);
            }
    
            if (array_key_exists('postit_id', $jsonObj)) {
                $postIt = $this->entityManager->find('KPM\Entities\PostIt', (int)$jsonObj['postit_id']);
                $comment->setPostIt($postIt);
            }
        }

        $comment->setText($jsonObj['text']);
    
        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        return $this->commentRepository->getCommentById($comment->getId());
    }

    public function delete($id)
    {
        $result = false;

        $comment = $this->entityManager->getReference('KPM\Entities\Comment', $id);
        if ($this->commentRepository->getCommentById($id)) {
            $this->entityManager->remove($comment);
            $this->entityManager->flush();
            $result = true;
        }

        return $result;
    }
}
