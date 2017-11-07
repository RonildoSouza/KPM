<?php
namespace KPM\Actions;

trait TraitAction
{
    protected function remove($id, $entityManager, $entityName, $objectExist)
    {
        if ($objectExist !== null) {
            $object = $entityManager->getReference($entityName, $id);
            $entityManager->remove($object);
            $entityManager->flush();
        }
        
        $object = $entityManager->getReference($entityName, $id);

        // \Doctrine\Common\Util\Debug::dump($object);

        return ($object === null);
    }

    protected function objectIsNull($object)
    {
        if ($object === null) {
            throw new \Exception(MSG_REGISTRY_NOT_EXIST);
        }

        return $object;
    }
}
