<?php
namespace KPM\Actions;

use Doctrine\ORM\EntityManager;

class CategoryPostItAction extends AbstractAction
{
    use TraitAction;

    private $categoryRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->categoryRepository = $this->entityManager->getRepository(CATEGORY_ENTITY_NAME);
    }

    public function get($aQSP = [], $id = 0)
    {
        $withPostIts = array_key_exists(KEY_WITH_POSTITS, $aQSP) ? $aQSP[KEY_WITH_POSTITS] : false;

        if ($id === 0) {
            $categories = $this->categoryRepository->getCategories($withPostIts);
        } else {
            $categories = $this->categoryRepository->getCategoryById($id, $withPostIts);
        }

        return $this->objectIsNull($categories);
    }
    
    public function postOrPut($jsonObj, $id = 0)
    {
        $category = new \KPM\Entities\CategoryPostIt();

        if ($id !== 0) {
            $category = $this->entityManager->find(CATEGORY_ENTITY_NAME, $id);
        }

        $category->setAcronym($jsonObj['acronym']);
        $category->setName($jsonObj['name']);
    
        $this->entityManager->persist($category);
        $this->entityManager->flush();

        return $this->categoryRepository->getCategoryById($category->getId());
    }

    public function delete($id)
    {
        $objectExist = $this->categoryRepository->getCategoryById($id);
        return $this->remove($id, $this->entityManager, CATEGORY_ENTITY_NAME, $objectExist);
    }
}
