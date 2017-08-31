<?php
namespace  KPM\Controllers;

use \KPM\Actions\ProjectAction;

final class ProjectController implements IController
{
    /**
     * @var \KPM\Actions\ProjectAction
     */
    private $projectAction;

    /**
     * Array of Query String Params
     *
     * @var array
     */
    private $aQSP = [];
    
    public function __construct(ProjectAction $projectAction)
    {
        $this->projectAction = $projectAction;
    }
    
    public function getAll($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $projects = $this->projectAction->get($this->aQSP);

            return $response->withJSON($projects, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }
    
    public function getById($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $project = $this->projectAction->get($this->aQSP, $args['id']);

            return $response->withJSON($project, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function insertOrUpdate($request, $response, $args)
    {
        try {
            $id = array_key_exists('id', $args) ? (int)$args['id'] : 0;
            $jsonObj = $request->getParsedBody();
            $project = $this->projectAction->postOrPut($jsonObj, $id);

            $statusCode = $request->isPost() ? 201 : 200;
            return $response->withJSON($project, $statusCode)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function delete($request, $response, $args)
    {
        try {
            $result = $this->projectAction->delete((int)$args['id']);

            $statusCode = $result ? 200 : 204;
            return $response->withStatus($statusCode);
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    private function setValueQueryParams($request)
    {
        $aQueryString = $request->getQueryParams();
        
        if ($aQueryString) {
            $keyWithPostIts = 'withPostIts';
            $keyWithCategories = 'withCategories';

            $resultWithPostIts = (array_key_exists($keyWithPostIts, $aQueryString) 
                                    && strtolower($aQueryString[$keyWithPostIts]) === 'true');
            $resultWithCategories = (array_key_exists($keyWithCategories, $aQueryString) 
                                    && strtolower($aQueryString[$keyWithCategories]) === 'true');

            $withPostIts = ($resultWithPostIts) ? true : false;
            $withCategories = ($resultWithCategories) ? true : false;

            $this->aQSP = array(
                $keyWithPostIts => $withPostIts,
                $keyWithCategories => $withCategories
            );
        }
    }
}
