<?php
namespace KPM\Actions;

trait TraitAction
{
    protected function remove($id, $entityManager, $entityName)
    {
        $object = $entityManager->getReference($entityName, $id);
        $entityManager->remove($object);
        $entityManager->flush();
    }    
}
