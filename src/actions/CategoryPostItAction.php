<?php
use \KPM\Actions\AbstractAction;

namespace KPM\Actions;
require('/../actions/AbstractAction.php');

class CategoryPostItAction extends AbstractAction
{
    /**
     * @param int|null $id
     *
     * @return array
     */
    public function get($id = null)
    {
        if ($id === null) {
            $categories = $this->entityManager->getRepository('KPM\Entities\CategoryPostIt')->findAll();
            // $categories = array_map(
            //     function ($category) {
            //         return $category->getArrayCopy();
            //     },
            //     $categories
            // );
            return $categories;
        } else {
            $category = $this->entityManager->getRepository('KPM\Entities\CategoryPostIt')->findOneBy(
                array('id' => $id)
            );
            // if ($category) {
            //     return $category->getArrayCopy();
            // }

            return $category;
        }

        return false;
    }
}