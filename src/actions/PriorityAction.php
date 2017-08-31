<?php
namespace KPM\Actions;

use \Doctrine\ORM\EntityManager;
use \KPM\Actions\AbstractAction;

class PriorityAction extends AbstractAction
{
    private $priorityRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->priorityRepository = $this->entityManager->getRepository('KPM\Entities\Priority');
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
            $priority = $this->entityManager->find('KPM\Entities\Priority', $id);
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

        $priority = $this->entityManager->getReference('KPM\Entities\Priority', $id);
        if ($this->priorityRepository->getPriorityById($id)) {
            $this->entityManager->remove($priority);
            $this->entityManager->flush();
            $result = true;
        }

        return $result;
    }
}
