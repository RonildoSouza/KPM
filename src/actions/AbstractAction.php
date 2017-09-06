<?php
namespace KPM\Actions;

use Doctrine\ORM\EntityManager;

abstract class AbstractAction
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager = null;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * It has to return one and\or more records.
     *
     * @param array $aQSP
     * @param integer $id
     * @return array
     */
    abstract protected function get($aQSP = [], $id = 0);

    /**
     * Include or modify records in DB.
     *
     * @param array $jsonObj
     * @param integer $id
     * @return object
     */
    abstract protected function postOrPut($jsonObj, $id = 0);

    /**
     * Delete record in DB.
     *
     * @param integer $id
     * @return boolean
     */
    abstract protected function delete($id);
}
