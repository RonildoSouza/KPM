<?php
namespace KPM\Actions;

use \Doctrine\ORM\EntityManager;
use \KPM\Actions\AbstractAction;

// require('/../actions/AbstractAction.php');

class PermissionAction extends AbstractAction
{
    private $permissionRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->permissionRepository = $this->entityManager->getRepository('KPM\Entities\Permission');
    }

    public function get($aQSP = [], $id = 0)
    {
        if ($id === 0) {
            $permissions = $this->permissionRepository->getPermissions();
            return $permissions;
        } else {
            $comment = $this->permissionRepository->getPermissionById($id);
            return $comment;
        }
    }
    
    public function postOrPut($jsonObj, $id = 0){}

    public function delete($id){}
}
