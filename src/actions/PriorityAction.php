<?php
namespace KPM\Actions;

use Doctrine\ORM\EntityManager;

class PriorityAction extends AbstractAction
{
    use TraitAction;

    private $priorityRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->priorityRepository = $this->entityManager->getRepository(PRIORITY_ENTITY_NAME);
    }

    public function get($aQSP = [], $id = 0)
    {
        $withPostIts = array_key_exists('withPostIts', $aQSP) ? $aQSP['withPostIts'] : false;

        if ($id === 0) {
            $priorities = $this->priorityRepository->getPriorities($withPostIts);
            return $priorities;
        } else {
            $priority = $this->priorityRepository->getPriorityById($id, $withPostIts);
            return $priority;
        }
    }
    
    public function postOrPut($jsonObj, $id = 0)
    {
        $priority = new \KPM\Entities\Priority();

        if ($id !== 0) {
            $priority = $this->entityManager->find(PRIORITY_ENTITY_NAME, $id);
        }

        $priority->setName($jsonObj['name']);
        $priority->setColor($jsonObj['color']);
    
        $this->entityManager->persist($priority);
        $this->entityManager->flush();

        return $this->priorityRepository->getPriorityById($priority->getId());
    }

    public function delete($id)
    {
        $result = false;

        if ($this->priorityRepository->getPriorityById($id)) {
            $this->remove($id, $this->entityManager, PRIORITY_ENTITY_NAME);
            $result = true;
        }

        return $result;
    }
}
