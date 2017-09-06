<?php
namespace KPM\Actions;

use Doctrine\ORM\EntityManager;

class StatusAction extends AbstractAction
{
    use TraitAction;

    private $statusRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->statusRepository = $this->entityManager->getRepository(STATUS_ENTITY_NAME);
    }

    public function get($aQSP = [], $id = 0)
    {
        $withPostIts = array_key_exists(KEY_WITH_POSTITS, $aQSP) ? $aQSP[KEY_WITH_POSTITS] : false;

        if ($id === 0) {
            $status = $this->statusRepository->getStatus($withPostIts);
        } else {
            $status = $this->statusRepository->getStatusById($id, $withPostIts);
        }

        return $this->objectIsNull($status);
    }
    
    public function postOrPut($jsonObj, $id = 0)
    {
        $status = new \KPM\Entities\Status();

        if ($id !== 0) {
            $status = $this->entityManager->find(STATUS_ENTITY_NAME, $id);
        }

        $status->setName($jsonObj['name']);
        $status->setColor($jsonObj['color']);
        $status->setIcon($jsonObj['icon']);
        $status->setDisplayOrder((int)$jsonObj['displayOrder']);
    
        $this->entityManager->persist($status);
        $this->entityManager->flush();

        return $this->statusRepository->getStatusById($status->getId());
    }

    public function delete($id)
    {
        $objectExist = $this->statusRepository->getStatusById($id);
        return $this->remove($id, $this->entityManager, STATUS_ENTITY_NAME, $objectExist);
    }
}
