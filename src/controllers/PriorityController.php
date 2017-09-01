<?php
namespace  KPM\Controllers;

use KPM\Actions\PriorityAction;

final class PriorityController implements IController
{
    /**
     * @var KPM\Actions\PriorityAction
     */
    private $priorityAction;

    /**
     * Array of Query String Params
     *
     * @var array
     */
    private $aQSP = [];
    
    public function __construct(PriorityAction $priorityAction)
    {
        $this->priorityAction = $priorityAction;
    }
    
    public function getAll($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $priorities = $this->priorityAction->get($this->aQSP);

            return $response->withJSON($priorities, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }
    
    public function getById($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $priority = $this->priorityAction->get($this->aQSP, $args['id']);

            return $response->withJSON($priority, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function insertOrUpdate($request, $response, $args)
    {
        try {
            $id = array_key_exists('id', $args) ? (int)$args['id'] : 0;
            $jsonObj = $request->getParsedBody();
            $priority = $this->priorityAction->postOrPut($jsonObj, $id);

            $statusCode = $request->isPost() ? 201 : 200;
            return $response->withJSON($priority, $statusCode)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function delete($request, $response, $args)
    {
        try {
            $result = $this->priorityAction->delete((int)$args['id']);

            $statusCode = $result ? 200 : 204;
            return $response->withStatus($statusCode);
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    private function setValueQueryParams($request)
    {
        $aQueryString = $request->getQueryParams();
        
        if ($aQueryString && array_key_exists('withPostIts', $aQueryString)) {
            $withPostIts = (strtolower($aQueryString['withPostIts']) === 'true') ? true : false;
            $this->aQSP = array(
                'withPostIts' => $withPostIts
            );
        }
    }
}
