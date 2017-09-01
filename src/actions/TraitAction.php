<?php
namespace KPM\Actions;

trait TraitAction
{
    protected function remove($id, $entityManager, $entityName)
    {
        $status = $entityManager->getReference($entityName, $id);
        $entityManager->remove($status);
        $entityManager->flush();
    }    
}
