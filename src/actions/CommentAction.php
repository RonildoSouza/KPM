<?php
namespace KPM\Actions;

use Doctrine\ORM\EntityManager;

class CommentAction extends AbstractAction
{
    use TraitAction;

    private $commentRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->commentRepository = $this->entityManager->getRepository(COMMENT_ENTITY_NAME);
    }

    public function get($aQSP = [], $id = 0)
    {
        if ($id === 0) {
            $comments = $this->commentRepository->getComments();
        } else {
            $comments = $this->commentRepository->getCommentById($id);
        }

        return $this->objectIsNull($comments);
    }
    
    public function postOrPut($jsonObj, $id = 0)
    {
        $comment = new \KPM\Entities\Comment();

        if ($id !== 0) {
            $comment = $this->entityManager->find(COMMENT_ENTITY_NAME, $id);
            $comment->setUpdatedAt(new \DateTime('now'));
        } else {
            $comment->setCreatedAt(new \DateTime('now'));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (array_key_exists('user_id', $jsonObj)) {
                $user = $this->entityManager->find(USER_ENTITY_NAME, (int)$jsonObj['user_id']);
                $comment->setUser($user);
            }
    
            if (array_key_exists('postit_id', $jsonObj)) {
                $postIt = $this->entityManager->find(POSTIT_ENTITY_NAME, (int)$jsonObj['postit_id']);
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
        $objectExist = $this->commentRepository->getCommentById($id);
        return $this->remove($id, $this->entityManager, COMMENT_ENTITY_NAME, $objectExist);
    }
}
