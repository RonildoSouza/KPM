<?php
namespace KPM\Actions;

use \Doctrine\ORM\EntityManager;
use \KPM\Actions\AbstractAction;

class CategoryPostItAction extends AbstractAction
{
    private $categoryRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->categoryRepository = $this->entityManager->getRepository('KPM\Entities\CategoryPostIt');
    }

    public function get($aQSP = [], $id = 0)
    {
        $withPostIts = array_key_exists('withPostIts', $aQSP) ? $aQSP['withPostIts'] : false;

        if ($id === 0) {
            $categories = $this->categoryRepository->getCategories($withPostIts);
            return $categories;
        } else {
            $category = $this->categoryRepository->getCategoryById($id, $withPostIts);
            return $category;
        }
    }
    
    public function postOrPut($jsonObj, $id = 0)
    {
        $category = new \KPM\Entities\CategoryPostIt();

        if ($id !== 0) {
            $category = $this->entityManager->find('KPM\Entities\CategoryPostIt', $id);
        }

        $category->setAcronym($jsonObj['acronym']);
        $category->setName($jsonObj['name']);
    
        $this->entityManager->persist($category);
        $this->entityManager->flush();

        return $this->categoryRepository->getCategoryById($category->getId());
    }

    public function delete($id)
    {
        $result = false;

        $category = $this->entityManager->getReference('KPM\Entities\CategoryPostIt', $id);
        if ($this->categoryRepository->getCategoryById($id)) {
            $this->entityManager->remove($category);
            $this->entityManager->flush();
            $result = true;
        }

        return $result;
    }
}
