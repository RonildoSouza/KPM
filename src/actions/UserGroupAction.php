<?php
namespace KPM\Actions;

use Doctrine\ORM\EntityManager;

class UserGroupAction extends AbstractAction
{
    use TraitAction;

    private $userGroupRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->userGroupRepository = $this->entityManager->getRepository(USERGROUP_ENTITY_NAME);
    }

    public function get($aQSP = [], $id = 0)
    {
        $withUsers = array_key_exists('withUsers', $aQSP) ? $aQSP['withUsers'] : false;

        if ($id === 0) {
            $userGroups = $this->userGroupRepository->getUserGroups($withUsers);
            return $userGroups;
        } else {
            $userGroup = $this->userGroupRepository->getUserGroupById($id, $withUsers);
            return $userGroup;
        }
    }
    
    public function postOrPut($jsonObj, $id = 0)
    {
        $userGroup = new \KPM\Entities\UserGroup();               

        if ($id !== 0) {
            $userGroup = $this->entityManager->find(USERGROUP_ENTITY_NAME, $id);            
            $groupPermissions = $userGroup->getGroupPermissions();
            $groupPermissions->clear();
        }

        foreach ($jsonObj['permissions'] as $p) {
            $permission = $this->entityManager->find(PERMISSION_ENTITY_NAME, (int)$p['id']);            
            $userGroup->addGroupPermission($permission, (bool)$p['isAllowed']);
        }

        $userGroup->setName($jsonObj['name']);

        // \Doctrine\Common\Util\Debug::dump($userGroup->getGroupPermissions());
    
        $this->entityManager->persist($userGroup);
        $this->entityManager->flush();

        return $this->userGroupRepository->getUserGroupById($userGroup->getId());
    }

    public function delete($id)
    {
        $result = false;

        if ($this->userGroupRepository->getUserGroupById($id)) {
            $this->remove($id, $this->entityManager, USERGROUP_ENTITY_NAME);
            $result = true;
        }

        return $result;
    }
}
