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
            $postIt->setUpdatedAt(new \DateTime('now'));

            foreach ($jsonObj['remove_users_id'] as $userId) {
                $user = $priority = $this->entityManager->find(USER_ENTITY_NAME, $userId);
                $postIt->removeUserPostIt($user);
            }
        } else {
            $user = $priority = $this->entityManager->find(USER_ENTITY_NAME, (int)$jsonObj['user_owner_id']);
            $postIt->setUserPostIt($user, true);

            $status = $priority = $this->entityManager->find(STATUS_ENTITY_NAME, (int)$jsonObj['status_id']);
            $postIt->setStatus($status);

            $postIt->setCreatedAt(new \DateTime('now'));
        }

        $postIt->setTitle($jsonObj['title']);
        $postIt->setSummary($jsonObj['summary']);
        $postIt->setEstimatedTime((int)$jsonObj['estimatedTime']);

        $priority = $this->entityManager->find(PRIORITY_ENTITY_NAME, (int)$jsonObj['priority_id']);
        $postIt->setPriority($priority);

        $project = $this->entityManager->find(PROJECT_ENTITY_NAME, (int)$jsonObj['project_id']);
        $postIt->setProject($project);

        $category = $this->entityManager->find(CATEGORY_ENTITY_NAME, (int)$jsonObj['category_id']);
        $postIt->setCategory($category);
    
        $this->entityManager->persist($postIt);
        $this->entityManager->flush();

        return $this->postItRepository->getPostItById($postIt->getId());
    }

    public function changeStatus($jsonObj, $id = 0)
    {
        if (!isset($id) || $id === 0) {
            throw new \Exception('Post-it id not valid!');
        }

        $status = $this->entityManager->find(STATUS_ENTITY_NAME, (int)$jsonObj['status_id']);
        $user = $this->entityManager->find(USER_ENTITY_NAME, (int)$jsonObj['user_id']);

        $postIt = $this->entityManager->find(POSTIT_ENTITY_NAME, $id);
        $postIt->setUserPostIt($user);
        $postIt->setUpdatedAt(new \DateTime('now'));
        $postIt->setStatus($status);
    
        $this->entityManager->persist($postIt);
        $this->entityManager->flush();

        return $this->postItRepository->getPostItById($postIt->getId());
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
