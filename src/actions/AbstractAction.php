<?php
namespace KPM\Actions;

use \Doctrine\ORM\EntityManager;

abstract class AbstractAction
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager = null;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    abstract protected function get($id = 0);
    abstract protected function postOrPut($jsonObj);
    abstract protected function delete($id);
}