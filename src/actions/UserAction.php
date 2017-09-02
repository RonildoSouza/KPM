<?php
namespace KPM\Actions;

use Doctrine\ORM\EntityManager;

class UserAction extends AbstractAction
{
    use TraitAction;

    private $userRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->userRepository = $this->entityManager->getRepository(USER_ENTITY_NAME);
    }

    public function get($aQSP = [], $id = 0)
    {
        $withPostIts = array_key_exists('withPostIts', $aQSP) ? $aQSP['withPostIts'] : false;
        $withComments = array_key_exists('withComments', $aQSP) ? $aQSP['withComments'] : false;

        if ($id === 0) {
            $users = $this->userRepository->getUsers($withPostIts, $withComments);
            return $users;
        } else {
            $user = $this->userRepository->getUserById($id, $withPostIts, $withComments);
            return $user;
        }
    }

    public function postOrPut($jsonObj, $id = 0)
    {
        $user = new \KPM\Entities\User();
        $userGroup = $this->entityManager->find(USERGROUP_ENTITY_NAME, (int)$jsonObj['usergroup_id']);

        if ($id !== 0) {
            $user = $this->entityManager->find(USER_ENTITY_NAME, $id);
        }
        
        $user->setName($jsonObj['name']);
        $user->setLogin($jsonObj['login']);
        $user->setPassword($jsonObj['password']);
        $user->setUserGroup($userGroup);
    
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->userRepository->getUserById($user->getId());
    }

    public function delete($id)
    {
        $result = false;

        if ($this->userRepository->getUserById($id)) {
            $this->remove($id, $this->entityManager, USER_ENTITY_NAME);
            $result = true;
        }

        return $result;
    }
}
