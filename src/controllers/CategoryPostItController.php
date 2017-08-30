<?php
namespace  KPM\Controllers;

use \KPM\Actions\CategoryPostItAction;

final class CategoryPostItController
{
    /**
     * @var \KPM\Actions\CategoryPostItAction
     */
    private $categoryAction;

    /**
     * Query string param
     *
     * @var boolean
     */
    private $withPostIts = false;
    
    public function __construct(CategoryPostItAction $categoryAction)
    {
        $this->categoryAction = $categoryAction;
    }
    
    public function getAll($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);
            
            $categories = $this->categoryAction->get(0, $this->withPostIts);

            return $response->withJSON($categories, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }
    
    public function getById($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $category = $this->categoryAction->get($args['id'], $this->withPostIts);

            return $response->withJSON($category, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function insertOrUpdate($request, $response, $args)
    {
        try {
            $jsonObj = $request->getParsedBody();
            $category = $this->categoryAction->postOrPut($jsonObj);

            $statusCode = $request->isPost() ? 201 : 200;

            return $response->withJSON($category, $statusCode)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function delete($request, $response, $args)
    {
        try {
            $result = $this->categoryAction->delete((int)$args['id']);

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
            $this->withPostIts = (strtolower($aQueryString['withPostIts']) === 'true') ? true : false;
        }
    }
}
