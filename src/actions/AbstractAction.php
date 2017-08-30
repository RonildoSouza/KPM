<?php
namespace KPM\Actions;

abstract class AbstractAction
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager = null;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    abstract protected function get($id = null);
    // abstract protected function post($obj);
    // abstract protected function put($id);
    // abstract protected function delete($onj);
}