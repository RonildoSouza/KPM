<?php
namespace KPM\Actions;

use Doctrine\ORM\EntityManager;

class PermissionAction extends AbstractAction
{
    use TraitAction;
    
    private $permissionRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->permissionRepository = $this->entityManager->getRepository(PERMISSION_ENTITY_NAME);
    }

    public function get($aQSP = [], $id = 0)
    {
        if ($id === 0) {
            $permissions = $this->permissionRepository->getPermissions();
        } else {
            $permissions = $this->permissionRepository->getPermissionById($id);
        }
        
        return $this->objectIsNull($permissions);
    }
    
    public function postOrPut($jsonObj, $id = 0)
    {
        throw new \Exception('Not implemented!');
    }

    public function delete($id)
    {
        throw new \Exception('Not implemented!');
    }
}
