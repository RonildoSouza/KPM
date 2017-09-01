<?php
namespace  KPM\Controllers;

use KPM\Actions\StatusAction;

final class StatusController implements IController
{
    /**
     * @var KPM\Actions\StatusAction
     */
    private $statusAction;

    /**
     * Array of Query String Params
     *
     * @var array
     */
    private $aQSP = [];
    
    public function __construct(StatusAction $statusAction)
    {
        $this->statusAction = $statusAction;
    }
    
    public function getAll($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $status = $this->statusAction->get($this->aQSP);

            return $response->withJSON($status, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }
    
    public function getById($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $status = $this->statusAction->get($this->aQSP, $args['id']);

            return $response->withJSON($status, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function insertOrUpdate($request, $response, $args)
    {
        try {
            $id = array_key_exists('id', $args) ? (int)$args['id'] : 0;
            $jsonObj = $request->getParsedBody();
            $status = $this->statusAction->postOrPut($jsonObj, $id);

            $statusCode = $request->isPost() ? 201 : 200;
            return $response->withJSON($status, $statusCode)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function delete($request, $response, $args)
    {
        try {
            $result = $this->statusAction->delete((int)$args['id']);

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
