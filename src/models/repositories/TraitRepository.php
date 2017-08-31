<?php
namespace KPM\Repositories;

trait TraitRepository
{
    protected function getAll($dql, $entityManager)
    {        
        $query = $entityManager->createQuery($dql);

        $arrayResult = $query->getArrayResult();        
        return $arrayResult;
    }

    protected function getById($dql, $entityManager, $id)
    {        
        $query = $entityManager->createQuery($dql)
                               ->setParameter(1, $id);        

        $arrayResult = $query->getArrayResult();
        return $arrayResult[0];
    }
}
