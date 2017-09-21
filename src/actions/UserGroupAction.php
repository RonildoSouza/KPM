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
        $withUsers = array_key_exists(KEY_WITH_USERS, $aQSP) ? $aQSP[KEY_WITH_USERS] : false;

        if ($id === 0) {
            $userGroups = $this->userGroupRepository->getUserGroups($withUsers);
        } else {
            $userGroups = $this->userGroupRepository->getUserGroupById($id, $withUsers);
        }

        return $this->objectIsNull($userGroups);
    }
    
    public function postOrPut($jsonObj, $id = 0)
    {
        $userGroup = new \KPM\Entities\UserGroup();
        $groupPermissions = null;

        if ($id !== 0) {
            $userGroup = $this->entityManager->find(USERGROUP_ENTITY_NAME, $id);
            $groupPermissions = $userGroup->getGroupPermissions();
        }

        foreach ($jsonObj['permissions'] as $p) {
            $permissionExist = false;
            $permission = $this->entityManager->find(PERMISSION_ENTITY_NAME, (int)$p['id']);
            
            if ($groupPermissions) {
                foreach ($groupPermissions as $gp) {
                    if ($gp->getPermission()->getId() === $permission->getId()) {
                        $gp->setIsAllowed((bool)$p['is_allowed']);
                        $permissionExist = true;
                        break;
                    }
                }
            }

            if (!$permissionExist) {
                $userGroup->addGroupPermission($permission, (bool)$p['is_allowed']);
            }
        }

        $userGroup->setName($jsonObj['name']);

        // \Doctrine\Common\Util\Debug::dump($userGroup->getGroupPermissions());
    
        $this->entityManager->persist($userGroup);
        $this->entityManager->flush();

        return $this->userGroupRepository->getUserGroupById($userGroup->getId());
    }

    public function delete($id)
    {
        $objectExist = $this->userGroupRepository->getUserGroupById($id);
        return $this->remove($id, $this->entityManager, USERGROUP_ENTITY_NAME, $objectExist);
    }
}
