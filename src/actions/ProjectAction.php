<?php
namespace KPM\Actions;

use Doctrine\ORM\EntityManager;

class ProjectAction extends AbstractAction
{
    use TraitAction;

    private $projectRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->projectRepository = $this->entityManager->getRepository(PROJECT_ENTITY_NAME);
    }

    public function get($aQSP = [], $id = 0)
    {
        $withPostIts = array_key_exists(KEY_WITH_POSTITS, $aQSP) ? $aQSP[KEY_WITH_POSTITS] : false;
        $withCategories = array_key_exists(KEY_WITH_CATEGORIES, $aQSP) ? $aQSP[KEY_WITH_CATEGORIES] : false;

        if ($id === 0) {
            $projects = $this->projectRepository->getProjects($withPostIts, $withCategories);
        } else {
            $projects = $this->projectRepository->getProjectById($id, $withPostIts, $withCategories);
        }

        return $this->objectIsNull($projects);
    }

    public function postOrPut($jsonObj, $id = 0)
    {
        $categories = null;
        $project = new \KPM\Entities\Project();

        if ($id !== 0) {
            $project = $this->entityManager->find(PROJECT_ENTITY_NAME, $id);
            $categories = $project->getCategories();
            $categories->clear();
            foreach ($jsonObj['categories_id'] as $categoryId) {
                $category = $this->entityManager->find(CATEGORY_ENTITY_NAME, $categoryId);
                $categories->add($category);
            }
        } else {
            foreach ($jsonObj['categories_id'] as $categoryId) {
                $category = $this->entityManager->find(CATEGORY_ENTITY_NAME, $categoryId);
                $project->addCategory($category);
            }
        }

        $project->setAcronym($jsonObj['acronym']);
        $project->setName($jsonObj['name']);
        $project->setColor($jsonObj['color']);
        $project->setStartDate(new \DateTime($jsonObj['startDate']));
        $project->setEndDate(new \DateTime($jsonObj['endDate']));
        $project->setStatus((int)$jsonObj['status']);
    
        $this->entityManager->persist($project);
        $this->entityManager->flush();

        return $this->projectRepository->getProjectById($project->getId());
    }

    public function delete($id)
    {
        $objectExist = $this->projectRepository->getProjectById($id);
        return $this->remove($id, $this->entityManager, PROJECT_ENTITY_NAME, $objectExist);
    }
}
