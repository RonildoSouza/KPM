<?php
namespace KPM\Actions;

use Doctrine\ORM\EntityManager;

class PostItAction extends AbstractAction
{
    use TraitAction;

    private $postItRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->postItRepository = $this->entityManager->getRepository(POSTIT_ENTITY_NAME);
    }

    public function get($aQSP = [], $id = 0)
    {
        $withComments = array_key_exists('withComments', $aQSP) ? $aQSP['withComments'] : false;

        if ($id === 0) {
            $postIts = $this->postItRepository->getPostIts($withComments);
            return $postIts;
        } else {
            $postIt = $this->postItRepository->getPostItById($id, $withComments);
            return $postIt;
        }
    }
    
    public function postOrPut($jsonObj, $id = 0)
    {
        $postIt = new \KPM\Entities\PostIt();               

        if ($id !== 0) {
            $postIt = $this->entityManager->find(POSTIT_ENTITY_NAME, $id);
        }

        foreach ($jsonObj['permissions'] as $p) {
            $permission = $this->entityManager->find(PERMISSION_ENTITY_NAME, (int)$p['id']);            
            $postIt->addGroupPermission($permission, (bool)$p['isAllowed']);
        }

        $postIt->setName($jsonObj['name']);

        // \Doctrine\Common\Util\Debug::dump($postIt);
    
        $this->entityManager->persist($postIt);
        $this->entityManager->flush();

        return $this->postItRepository->getPostItById($postIt->getId());

        // {
        //     "title": "New Post-it",
        //     "summary": "Eiusmod ad Lorem voluptate veniam officia esse commodo excepteur amet tempor deserunt.",
        //     "estimatedTime": 240,
        //     "user_owner_id": 1

        //     "remove_users_id": [
        //         2,
        //         3
        //       ]
        // }
    }

    public function delete($id)
    {
        $result = false;

        if ($this->postItRepository->getPostItById($id)) {
            $this->remove($id, $this->entityManager, POSTIT_ENTITY_NAME);
            $result = true;
        }

        return $result;
    }
}
