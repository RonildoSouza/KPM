<?php
namespace KPM\Actions;

use \Doctrine\ORM\EntityManager;
use \KPM\Actions\AbstractAction;

class ProjectAction extends AbstractAction
{
    private $projectRepository;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->projectRepository = $this->entityManager->getRepository('KPM\Entities\Project');
    }

    public function get($aQSP = [], $id = 0)
    {
        $withPostIts = array_key_exists('withPostIts', $aQSP) ? $aQSP['withPostIts'] : false;
        $withCategories = array_key_exists('withCategories', $aQSP) ? $aQSP['withCategories'] : false;

        if ($id === 0) {
            $projects = $this->projectRepository->getProjects($withPostIts, $withCategories);
            return $projects;
        } else {
            $project = $this->projectRepository->getProjectById($id, $withPostIts, $withCategories);
            return $project;
        }
    }

    public function postOrPut($jsonObj, $id = 0)
    {
        $categories = null;
        $newCategories = null;
        $removeCategories = null;
        $project = new \KPM\Entities\Project();

        if ($id !== 0) {
            $project = $this->entityManager->find('KPM\Entities\Project', $id);
            $categories = $project->getCategories();
            $categories->clear();
            foreach ($jsonObj['categories_id'] as $categoryId) {
                $category = $this->entityManager->find('KPM\Entities\CategoryPostIt', $categoryId);
                $categories->add($category);
            }
        }
        else{
            foreach ($jsonObj['categories_id'] as $categoryId) {
                $category = $this->entityManager->find('KPM\Entities\CategoryPostIt', $categoryId);
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
        $result = false;

        $project = $this->entityManager->getReference('KPM\Entities\Project', $id);
        if ($this->projectRepository->getProjectById($id)) {
            $this->entityManager->remove($project);
            $this->entityManager->flush();
            $result = true;
        }

        return $result;
    }
}
